<?php 

declare(strict_types=1);

namespace App\Controller;

use App\Model\AbstractModel;
use App\Model\LoginModel;
use App\View;
use App\Request;


require_once('./src/Request.php');
require_once('AbstractController.php');
require_once('src/model/LoginModel.php');

class UserController extends AbstractController
{
    private View $view; 
    protected Request $request;
    private LoginModel $loginModel;
    
    public function __construct(Request $request, array $configuration)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->view = new View();
        $this->loginModel = new LoginModel($this->configuration['db']);
    }

    public function mainPage():void
    {
    }

    public function registerPage()
    {
        $inputValues = $this->request->postParams();
        if (isset($inputValues['registerBtn'])) {
            $this->loginModel->register($inputValues);
            $this->request->getParams('error');
        }
        

        $this->view->render('register', [
            'msg' => $this->request->getParams('msg')
        ]);
    }
    public function loginPage()
    {
        $inputValues = $this->request->postParams();
        $values = [];

        if (isset($inputValues['loginBtn'])) {
            if (empty($inputValues['email'])) {
                header("location: /?page=login&msg=emailError");
                exit;
            }else{
                $values['email'] = $inputValues['email'];
            }
            if (empty($inputValues['password'])) {
                header("location: /?page=login&msg=passwordError");
                exit;
            }else{
                $values['password'] = $inputValues['password'] ;
            }
        } 
        if ($values) {
            $data = $this->loginModel->login($values);
            if ($data) {
                $_SESSION['user'] = $data;
                if ($_SESSION['user']) {
                    header("location: /?");
                }
            }else{
                 header("location: /?page=login&msg=loginError");
                 exit;
            }
        }
        $this->view->render('login', $params ?? [
             'msg' => $this->request->getParams('msg')
        ]);
    }
    public function logoutPage()
    {
        $this->loginModel->logout();
    }
}