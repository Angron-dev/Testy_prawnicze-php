<?php 

declare(strict_types=1);

namespace App\Controller;

use App\Model\AbstractModel;
use App\View;
use App\Request;


require_once('./src/Request.php');
require_once('AbstractController.php');

class UserController extends AbstractController
{
    private View $view; 
    protected Request $request;
    public function __construct(Request $request, array $configuration)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->view = new View();
    }

    public function mainPage()
    {
        $this->view->render('login', []);
    }
    public function registerPage()
    {
        $this->view->render('register', []);
    }
}