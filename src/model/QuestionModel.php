<?php 

declare(strict_types=1);

namespace App\Model;

require_once('./src/model/AbstractModel.php');

use App\Model\AbstractModel;
use App\Exception\StorageException;
use PDO;

class QuestionModel extends AbstractModel
{
    public function get(string $type):array
    {
        try {
        $questions= [];
        if ($type) {
            $query = "SELECT * FROM $type";
            $result = $this->conn->query($query);
            $questions = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $questions;
        } catch (StorageException $e) {
            throw new StorageException('Nie znaleziono tabeli', 400, $e);
        }
    }

    public function create(array $data, string $type): void
    {
        if (!empty($data['question']) && 
        !empty($data['correct_answer']) && 
        !empty($data['answer_1']) && 
        !empty($data['answer_2'])) {

            $question = $this->conn->quote($data['question']);
            $correctAnswer = $this->conn->quote($data['correct_answer']);
            $answer_1 = $this->conn->quote($data['answer_1']);
            $answer_2 = $this->conn->quote($data['answer_2']);
 
            $query = "INSERT INTO `$type` ( `question`, `correct_answer`, `answer_1`, `answer_2`) 
            VALUES ($question, $correctAnswer, $answer_1, $answer_2)" ;

            $this->conn->exec($query);

            header("location: ?page=add&type=$type&msg=success");
        }
        else {
            header("location: ?page=add&type=$type&msg=error");
        }

    }
    public function delete(int $id, string $type): void
    {
        $query = "DELETE FROM $type WHERE id = $id LIMIT 1";
        $this->conn->exec($query);
        header("location: ?page=add&type=$type&msg=delete");
    }

    public function getQuestion (int $id, string $type): array
    {
        $question= [];
            $query = "SELECT * FROM $type WHERE id = $id";
            $result = $this->conn->query($query);
            $question = $result->fetch(PDO::FETCH_ASSOC);

        return $question;
    }

    public function edit(array $data, string $type):void
    {
        if (!empty($data['question']) && 
        !empty($data['correct_answer']) && 
        !empty($data['answer_1']) && 
        !empty($data['answer_2'])) {

            $question = $this->conn->quote($data['question']);
            $correctAnswer = $this->conn->quote($data['correct_answer']);
            $answer_1 = $this->conn->quote($data['answer_1']);
            $answer_2 = $this->conn->quote($data['answer_2']);
            $id = $data['id'];
 
            $query = "UPDATE $type SET question = $question, correct_answer = $correctAnswer, answer_1 = $answer_1, answer_2 = $answer_2 WHERE id = $id" ;
            
            $this->conn->exec($query);

            header("location: ?page=add&type=$type&msg=successEdit");
        }else{
            header("location: ?page=add&type=$type&msg=errorEdit");
        }

    }


}
