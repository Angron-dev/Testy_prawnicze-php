<?php

declare (strict_types=1);

namespace App\Controller;

use App\View;
use App\Request;
use App\Model\QuestionModel;
use App\Model\TestModel;
use App\Model\AbstractModel;
use App\Exception\StorageException;

use function PHPSTORM_META\type;

require_once('./src/Request.php');
require_once('./src/model/QuestionModel.php');
require_once('./src/model/TestModel.php');
require_once('AbstractController.php');
require_once('./src/Exeptions/StorageException.php');


class QuestionsController extends AbstractController
{
    private View $view; 
    private QuestionModel $questionModel;
    private TestModel $testModel;
    protected Request $request;

    public function __construct(Request $request, array $configuration)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->view = new View();
        $this->questionModel = new QuestionModel($this->configuration['db']);
        $this->testModel = new TestModel($this->configuration['db']);

    }
    public function mainPage(): void
    {       
        $session = $_SESSION['user'] ?? false;
        if ($this->request->getParams('page') == '') {
            if ($session) {
                $this->view->render('mainPage', []);
            }else{
                header("location: /?page=login");
            }
        }

    }    
    public function addPage():void
    {
        $session = $_SESSION['user'] ?? false;

        if ($this->request->getParams('type') != null) {
            $type = $this->request->getParams('type');
            if($this->request->getParams('action') != null){

                $action = $this->request->getParams('action');

                switch (true) {
                    case ($action == 'create'):
                        $data = $this->request->postParams('questionForm');

                        $this->questionModel->create($data, $type);
                        break;
                    case ($action == 'delete'):
                        $data = $this->request->postParams();
                        $data = (int) $data['id'];

                        $this->questionModel->delete($data, $type);
                        break;
                    case ($action == 'edit'):
                        $data = $this->request->postParams();
                        $data = (int) $data['id'];

                        $getQuestions = $this->questionModel->getQuestion($data, $type);

                        break;
                    case ($action == 'edited'):
                        $data = $this->request->postParams('questionForm');

                        $this->questionModel->edit($data, $type);
                        break;
                }
            }

            if ($this->request->getParams('msg') != null) {
                $msg = $this->request->getParams('msg');
            }

            $get = $this->questionModel->get($type);

            if ($session) {
                $this->view->render('addQuestion', [
                    'type' => $type, 
                    'get' => $get, 
                    'msg' => $msg ?? '', 
                    'getQuestion' => $getQuestions ?? null 
                    ]);
            }else{
                header("location: /?page=login");
            }

        }else{
            if ($session) {
                $this->view->render('questions', []);
            }else{
                header("location: /?page=login");
            }
        }
    }

    public function testPage():void
    {
        $session = $_SESSION['user'] ?? false;

        $this->request->getParams('type');
        if ($this->request->getParams('type') != null) {
            $type = $this->request->getParams('type');

            switch ($this->request->getParams('action')) {
                case 'startTest':
                    $limit = $this->request->postParams();
                    $limit = (int) $limit['limit'];

                   $getQuestions = $this->testModel->getTest($type, $limit);
                    break;
                case 'check':
                    $answers = $this->request->postParams();
                    $limit = count($answers);

                    $pointsScored = $this->testModel->testCheck($answers);
                    $points = ['pointsScored' => $pointsScored, 'limit' => $limit];
                    break;
            
            }
            if ($session) {
                $this->view->render('test', 
                ['type' => $type, 
                'points' => $points ?? null, 
                'getQuestion' => $getQuestions ?? []
                ]);
            }else{
                header("location: /?page=login");
            }

        }else{
            if ($session) {
                $this->view->render('tests', []);
            }else{
                header("location: /?page=login");
            }
            
        }
    }
}
