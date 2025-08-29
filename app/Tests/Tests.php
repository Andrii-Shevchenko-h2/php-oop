<?php

declare(strict_types = 1);

namespace App\Tests;

readonly abstract class Tests {
  protected abstract static function runTests();

  public static function runAllTests() {
    CircleTests::runTests();
    SquareTests::runTests();
    UserTests::runTests();
  }
}
