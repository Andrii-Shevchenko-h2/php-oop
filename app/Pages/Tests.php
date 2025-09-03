<?php

declare(strict_types = 1);

namespace App\Pages;

use \App\Tests as UnitTests;

readonly class Tests extends PageSkeleton implements RequestParser {
  private string $parsedGet;

  public function __construct() {
    $this->getParser();
    $body = '<p>Welcome to Tests!</p>';

    if (isset($this->parsedGet)) {
      $body .= $this->parsedGet;
    }

    $this->createDocument(body: $body);
    print $this->document;
  }

  public function getParser() {
    foreach ($_GET as $key => $value) {
      if ($key === 'unit') {
        $this->parsedGet = match($value) {
          'all' => nl2br(UnitTests\Tests::runAllTests()),
          'circle' => nl2br(UnitTests\CircleTests::runTests()),
          'square' => nl2br(UnitTests\SquareTests::runTests()),
          'user' => nl2br(UnitTests\UserTests::runTests()),
          'shapes-collection' => nl2br(UnitTests\ShapesCollectionTests::runTests()),
          default => '',
        };
      }
    }
  }

  public function postParser() {
    // TODO: implement
  }
}
