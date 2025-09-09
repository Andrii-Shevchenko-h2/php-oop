<?php

declare(strict_types=1);

use \App\View;
use \App\Tests as UnitTests;
use \App\Exceptions\AppException;

$parsedGet;

$parseGET = function () {
  if (isset($_GET['unit'])) {
    return match ($_GET['unit']) {
      'all' => nl2br(UnitTests\AllTests::runTests()),
      'circle' => nl2br(UnitTests\CircleTests::runTests()),
      'square' => nl2br(UnitTests\SquareTests::runTests()),
      'user' => nl2br(UnitTests\UserTests::runTests()),
      '' => '',
      default => AppException::invalidTestParameterURI($_GET['unit']),
    };
  } elseif (isset($_GET['create'])) {
    $parameters = $_GET;
    unset($parameters['create']);

    return match ($_GET['create']) {
      'circle' => nl2br(UnitTests\CircleTests::createTest($parameters)),
      'square' => nl2br(UnitTests\SquareTests::createTest($parameters)),
      '', 'new' => UnitTests\TestConstructor::getDocumentForm(),
      default => AppException::invalidTestParameterURI($_GET['create']),
    };
  } else {
    return '<h1>Welcome to the tests page!</h1><p>You have to change the URL to create or call a test.</p>';
  }
};

print $parseGET();
