<?php

declare(strict_types=1);

namespace App\Tests;

abstract class AllTests extends TestConstructor
{
  public static function runTests(): void
  {
    CircleTests::runTests();
    SquareTests::runTests();
    UserTests::runTests();
  }
}
