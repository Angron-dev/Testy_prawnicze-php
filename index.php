<?php 

declare (strict_types=1);

namespace App;


use App\Request;
use App\Controller\AbstractController;
use App\Controller\QuestionsController;
use App\Controller\UserController;
use App\Exception\ConfigurationException;
use App\Exception\AppException;
use App\Model\QuestionModel;

require_once("src/View.php");
require_once("src/Request.php");
require_once("src/Controllers/AbstractController.php");
require_once ("src/Controllers/QuestionsController.php");
require_once ("src/Controllers/UserController.php");
require_once ("src/Exeptions/ConfigurationException.php");
require_once ("src/Exeptions/AppException.php");

$configuration = require_once("config/config.php");

$request = new Request($_GET, $_POST, $_SERVER);

try {
  AbstractController::initConfiguration($configuration);


  $questionController = new QuestionsController($request, $configuration);
  $questionController->run();
  $userController = new UserController($request, $configuration);
  $userController->run();

  
} catch (ConfigurationException $e) {
  echo '<h1>Wystąpił błąd w aplikacji</h1>';
  echo 'Problem z applikacją, proszę spróbować za chwilę.';
}catch (AppException $e) {
  echo '<h1>Wystąpił błąd w aplikacji</h1>';
  echo '<h3>' . $e->getMessage() . '</h3>';
}catch (\Throwable $e) {
  echo '<h1>Wystąpił błąd w aplikacji</h1>';
  echo'<pre>';
  var_dump($e);
  echo '<pre>';
}