<?php 

declare(strict_types=1);

namespace App\Model;

use App\Model\AbstractModel;
use App\Exception\StorageException;
use App\Request;
use PDO;

require_once("AbstractModel.php");
require_once("src/Request.php");
require_once("./src/Exeptions/StorageException.php");

class LoginModel extends AbstractModel 
{
    public function login(array $inputValues)
    {
        try {
            $email = $inputValues['email'] ;
            $password = $inputValues['password'];

            $query = "SELECT id, password FROM users WHERE email = '$email'" ;
            $result = $this->conn->query($query);
            $data = $result->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                if (password_verify($password, $data['password'])) {
                    return $data['id'];
                }else if($password == $data['password']){
                    return $data['id'];
                }
            }else{
                return false;
            }

        } catch (StorageException $e) {
            throw new StorageException('Nie znaleziono tabeli', 400, $e);
        }
    }
    public function logout():void
    {
        unset($_SESSION['user']);
        header("location: /?page=login");
        exit;
    }
    public function register(array $inputValues):void
    {
            $email = $inputValues['email'] ;
            $userName = $inputValues['user_name'] ;
            $password = $inputValues['password'] ;
            $passwordRepeat = $inputValues['password-repeat'] ;

        if ($this->emailCheck($email)) {
             header('location: /?page=register&msg=emailError');
        }else{
            if ($password == $passwordRepeat ) {
                if (strlen($password) > 5) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                }else{
                    header('location: ?page=register&msg=passwordLength');
                    exit;
                }
            }else{
                header('location: ?page=register&msg=passwordError');
                exit;
            }
            if (!empty($email) && 
            !empty($userName) && 
            !empty($passwordHash)) {
                $query = "INSERT INTO `users`( `user_name`, `email`, `password`) VALUES ('$userName','$email','$passwordHash')";

                $this->conn->exec($query);
               header('location: ?page=login&msg=success');
            }else{
                header('location: ?page=register&msg=emptyInput');
            }
        }
    }
    private function emailCheck(string $email): bool
    {
        $query = "SELECT id FROM users WHERE email = '$email' " ;
        $result = $this->conn->query($query);
        $userID = $result->fetch(PDO::FETCH_ASSOC);
        if ($userID) {
            return true;
        }else{
            return false;
        }
    }
}
