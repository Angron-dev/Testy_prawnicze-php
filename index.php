<<<<<<< HEAD
<?php 

declare (strict_types=1);

namespace App;

use App\Controller\Controller;

require_once("src/View.php");
require_once ("src/Controllers/Controller.php");
$configuration = require_once("config/config.php");

$request = [
  'get' => $_GET,
  'post'=> $_POST
];

$controller = new Controller($request, $configuration);
=======
<?php 

declare (strict_types=1);

namespace App;

use App\Controller\Controller;

require_once("src/View.php");
require_once ("src/Controllers/Controller.php");
$configuration = require_once("config/config.php");

$request = [
  'get' => $_GET,
  'post'=> $_POST
];

$controller = new Controller($request, $configuration);
>>>>>>> a1b8dcf (Możliwość dodawania, usuwania i przeglądania pytań oraz możliwość rozwiązywania testów.)
$controller->run();