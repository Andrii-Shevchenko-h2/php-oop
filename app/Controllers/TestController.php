<?php

declare(strict_types=1);

namespace App\Controllers;

use \App\Tests;
use \App\Core\View;
use \App\Exceptions\AppException;
use \App\Controllers\TestConstructor;

final class TestController
{
  public static function handleRequest()
  {
    if (isset($_GET['unit'])) {
      match ($_GET['unit']) {
        'all' => Tests\All::runTests(),
        'circle' => Tests\Circle::runTests(),
        'square' => Tests\Square::runTests(),
        'user' => Tests\User::runTests(),
        '' => '',
        default => AppException::invalidTestParameterURI($_GET['unit']),
      };
    } elseif (isset($_GET['create'])) {
      $parameters = $_GET;
      unset($parameters['create']);

      match ($_GET['create']) {
        'circle' => Tests\Circle::create($parameters),
        'square' => Tests\Square::create($parameters),
        '', 'new' => TestConstructor::createForm(),
        default => AppException::invalidTestParameterURI($_GET['create']),
      };
    } else {
      View::render('tests/default.php');
    }
  }
}
