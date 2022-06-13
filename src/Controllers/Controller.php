<<<<<<< HEAD
<?php

declare (strict_types=1);

namespace App\Controller;

use App\View;
use App\Model\QuestionModel;

require_once('./src/model/QuestionModel.php');

class Controller 
{
    private array $request;
    private View $view; 
    private QuestionModel $questionModel;

    public function __construct(array $request, array $configuration)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->view = new View();
        $this->questionModel = new QuestionModel($this->configuration['db']);
    }
    public function run():void 
    {
       $type = $this->getParams('type');
       $question = [];

        switch ($this->getParams('page')) {
            case 'add':
                $page = 'questions';
                if ($this->getParams('type')) {
                    $page = 'addQuestion';

                    if ($this->getParams('action') == 'create') {
                        $type = $this->getParams('type');
                        $data = $this->getRequestPost();

                        $this->questionModel->create($data, $type);

                    }else if ($this->getParams('action') == 'delete') {
                        $id = $this->getRequestPost('id');
                        $type = $this->getParams('type');

                        $this->questionModel->delete((int) $id['id'], $type);

                    }else if ($this->getParams('action') == 'edit') {
                        $id = $this->getRequestPost('id');
                        $type = $this->getParams('type');
                        $question = $this->questionModel->getQuestion((int) $id['id'], $type);
                    }
                    else if ($this->getParams('action') == 'edited') {
                        $data = $this->getRequestPost();
                        $type = $this->getParams('type');

                        $this->questionModel->edit($data, $type);
                    }
                }
                break;
            case 'test':
                $page = 'tests';
                if ($this->getParams('type')) {
                    $page = 'test';
                }
                break;
            default:
                $page = 'mainPage';
                break;
        }

        $this->view->render($page, $this->params($question));
    }


    public function getParams(string $name, string $default = ""): string
    {
        $params = $this-> getRequestGet(); 
        return $params[$name] ?? $default;
    }

    public function postParams(string $name, string $default = ""): string
    {
        $params = $this-> getRequestPost(); 
        return $params[$name] ?? $default;
    }
    public function params(array $question = []):array
    {
        $params = [ 
            'get' => $this->questionModel->get($this->getParams('type')),
            'type' => $this->getParams('type'),
            'msg' => $this->getParams('msg'),
            'getQuestion' => $question
        ];

        return $params;
    }
    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }
}
=======
<?php

declare (strict_types=1);

namespace App\Controller;

use App\View;
use App\Model\QuestionModel;
use App\Model\TestModel;

require_once('./src/model/QuestionModel.php');
require_once('./src/model/TestModel.php');

class Controller 
{
    private array $request;
    private View $view; 
    private QuestionModel $questionModel;
    private TestModel $testModel;

    public function __construct(array $request, array $configuration)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->view = new View();
        $this->questionModel = new QuestionModel($this->configuration['db']);
        $this->testModel = new TestModel($this->configuration['db']);
    }
    public function run():void 
    {
       $type = $this->getParams('type');
       $question = [];
       $points = [];

        switch ($this->getParams('page')) {
            case 'add':
                $page = 'questions';
                if ($this->getParams('type')) {
                    $page = 'addQuestion';
                    $type = $this->getParams('type');

                    if ($this->getParams('action') == 'create') {
                        $data = $this->getRequestPost();

                        $this->questionModel->create($data, $type);

                    }else if ($this->getParams('action') == 'delete') {
                        $id = $this->getRequestPost('id');

                        $this->questionModel->delete((int) $id['id'], $type);

                    }else if ($this->getParams('action') == 'edit') {
                        $id = $this->getRequestPost('id');
                        $question = $this->questionModel->getQuestion((int) $id['id'], $type);
                    }
                    else if ($this->getParams('action') == 'edited') {
                        $data = $this->getRequestPost();

                        $this->questionModel->edit($data, $type);
                    }
                }
                break;
            case 'test':
                $page = 'tests';
                if ($this->getParams('type')) {
                    $page = 'test';
                    $type = $this->getParams('type');
                    if ($this->getParams('action') == 'startTest') {
                        $limit = $this->postParams('limit');
                        
                        $question = $this->testModel->getTest($type, (int) $limit);

                    }else if($this->getParams('action') == 'check'){
                        $questions =  $this->getRequestPost();
                        $points = [
                           'pointsScored' => $this->testModel->testCheck($questions),
                           'limit' => count($questions)
                        ];
                    }          
                }
                break;
            default:
                $page = 'mainPage';
                break;
        }

        $this->view->render($page, $this->params($question, $points));
    }


    public function getParams(string $name, string $default = ""): string
    {
        $params = $this-> getRequestGet(); 
        return $params[$name] ?? $default;
    }

    public function postParams(string $name, string $default = ""): string
    {
        $params = $this-> getRequestPost(); 
        return $params[$name] ?? $default;
    }
    public function params(array $question = [], array $points = []):array
    {
        $params = [ 
            'get' => $this->questionModel->get($this->getParams('type')),
            'type' => $this->getParams('type'),
            'msg' => $this->getParams('msg'),
            'getQuestion' => $question,
            'points' => $points
        ];

        return $params;
    }
    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }
}
>>>>>>> a1b8dcf (Możliwość dodawania, usuwania i przeglądania pytań oraz możliwość rozwiązywania testów.)
