<?php 

declare (strict_types=1);

namespace App\Model;

require_once('./src/model/AbstractModel.php');

use App\Model\AbstractModel;
use PDO;
use App\Exception\StorageException;

class TestModel extends AbstractModel 
{
    public function getTest(string $type, int $limit):array
    {
        try {
        $questions= [];
        if ($type) {
            $query = "SELECT * FROM $type ORDER BY RAND() LIMIT $limit";
            $result = $this->conn->query($query);
            $questions = $result->fetchAll(PDO::FETCH_ASSOC);
        }

        $shufle = function ($questions)
        {
            $corrAns = $questions['correct_answer'];
            $ans1 = $questions['answer_1'];
            $ans2 = $questions['answer_2'];

            $answers = [
            1 => $corrAns,
            2 => $ans1,
            3 => $ans2
            ];

            shuffle($answers);

            unset($questions['answer_1']);
            unset($questions['answer_2']);


            $questions['answers'] = $answers;

            return $questions;
        };
        $questions = array_map($shufle, $questions);

        return $questions;
        
        } catch (StorageException $e) {
            throw new StorageException('Nie znaleziono tabeli', 400, $e);
        }
    }
    public function testCheck(array $answers):int
    {
        $i = 0;

        foreach ($answers as $answer) {
            $correct =  $answer['correct'];
            $choosen = $answer['choosen'] ?? null;
            if ($correct == $choosen) {
                $i++;
            }
        }

        return (int) $i;
    }
}