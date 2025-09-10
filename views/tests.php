<?php

/*
 * Apology for this file's design
 *
 * Dear future me,
 *
 * I am writing to express my sincerest apologies for the state of this file.
 * I know - it's a view, and it's handling far too much logic. It should
 * have been a controller, or at the very least, a proper service that handles
 * the data processing before it gets here.
 *
 * This was a shortcut taken under time pressure, and it goes against
 * every best practice I hold dear. Please accept my regrets.
 *
 * With remorse,
 * Andrii
 */

declare(strict_types=1);

use \App\Core\View;
use \App\Tests;
use \App\Exceptions\AppException;

if (isset($_GET['unit'])) {
  match ($_GET['unit']) {
    'all' => Tests\AllTests::runTests(),
    'circle' => Tests\CircleTests::runTests(),
    'square' => Tests\SquareTests::runTests(),
    'user' => Tests\UserTests::runTests(),
    '' => '',
    default => AppException::invalidTestParameterURI($_GET['unit']),
  };
} elseif (isset($_GET['create'])) {
  $parameters = $_GET;
  unset($parameters['create']);

  match ($_GET['create']) {
    'circle' => Tests\CircleTests::createTest($parameters),
    'square' => Tests\SquareTests::createTest($parameters),
    '', 'new' => Tests\TestConstructor::createForm(),
    default => AppException::invalidTestParameterURI($_GET['create']),
  };
} else {
  View::render('tests/default.php');
}
