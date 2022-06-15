<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request;
use App\View;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;

require_once ('./src/Request.php');
require_once ('./src/View.php');
require_once ('./src/Exeptions/ConfigurationException.php');

class AbstractController 
{
    protected const DEFAULT_PAGE = 'main';

    private static array $configuration = [];
    protected Request $request;

    public static function initConfiguration(array $configuration): void
  {
    self::$configuration = $configuration;
  }
  public function __construct(Request $request)
  {
    if (empty(self::$configuration['db'])) {
      throw new ConfigurationException('Configuration error');
    }

    $this->request = $request;
    $this->view = new View();
  }

  final public function run():void
  {
    try {
        $page = $this->page() . 'page' ;

    if (!method_exists($this, $page)) {
        $page = self::DEFAULT_PAGE . 'page';
      }
    $this->$page();
    } catch (StorageException $e) {
        $this->view->render('error', ['message' => $e->getMessage()]);
    }
  }

  final public function page(): string
  {
    return $this->request->getParams('page', self::DEFAULT_PAGE);
  }
}
