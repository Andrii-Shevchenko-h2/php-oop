<?php

declare(strict_types=1);

namespace App\Tests;

final readonly class AllTests extends TestConstructor
{
  public static function runTests(): string
  {
    return (
      CircleTests::runTests() .
      SquareTests::runTests() .
      UserTests::runTests()
    );
  }
}
