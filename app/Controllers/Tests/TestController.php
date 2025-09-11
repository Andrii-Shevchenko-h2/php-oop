<?php

declare(strict_types=1);

namespace App\Controllers\Tests;

use \App\Core\View;
use \App\Exceptions\AppException;

final class TestController
{
  public static function handleRequest()
  {
    if (isset($_GET['unit'])) {
      match ($_GET['unit']) {
        'all' => AllTests::runTests(),
        'circle' => CircleTests::runTests(),
        'square' => SquareTests::runTests(),
        'user' => UserTests::runTests(),
        '' => '',
        default => AppException::invalidTestParameterURI($_GET['unit']),
      };
    } elseif (isset($_GET['create'])) {
      $parameters = $_GET;
      unset($parameters['create']);

      match ($_GET['create']) {
        'circle' => CircleTests::createTest($parameters),
        'square' => SquareTests::createTest($parameters),
        '', 'new' => TestConstructor::createForm(),
        default => AppException::invalidTestParameterURI($_GET['create']),
      };
    } else {
      View::render('tests/default.php');
    }
  }
}
