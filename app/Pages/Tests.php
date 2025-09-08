<?php

declare(strict_types=1);

namespace App\Pages;

use \App\Tests as UnitTests;
use \App\Exceptions\AppException;

readonly class Tests extends PageSkeleton implements RequestParser
{
  private string $parsedGet;
  private string $parsedPost;

  public function __construct()
  {
    $this->parseGET();
    $body = '<p>Welcome to Tests!</p>';

    if (isset($this->parsedGet)) {
      $body = $this->parsedGet;
    }

    $this->createDocument(body: $body);
    print $this->document;
  }

  public function parseGET(): void
  {
    if (isset($_GET['unit'])) {
      $this->parsedGet = '<p>Welcome to Unit Tests!</p>' . match ($_GET['unit']) {
        'all', '' => nl2br(UnitTests\AllTests::runTests()),
        'circle' => nl2br(UnitTests\CircleTests::runTests()),
        'square' => nl2br(UnitTests\SquareTests::runTests()),
        'user' => nl2br(UnitTests\UserTests::runTests()),
        default => AppException::invalidTestParameterURI($_GET['unit']),
      };
    } elseif (isset($_GET['create'])) {
      $parameters = $_GET;
      unset($parameters['create']);

      $this->parsedGet = '<p>Welcome to Test Creator!</p>' . match ($_GET['create']) {
        'circle' => nl2br(UnitTests\CircleTests::createTest($parameters)),
        'square' => nl2br(UnitTests\SquareTests::createTest($parameters)),
        '', 'new' => UnitTests\TestConstructor::getDocumentForm(),
        default => AppException::invalidTestParameterURI($_GET['create']),
      };
    }
  }

  public function parsePOST()
  {
    // TODO: implement
  }
}
