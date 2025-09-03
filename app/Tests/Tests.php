<?php

declare(strict_types = 1);

namespace App\Tests;

readonly abstract class Tests {
  public abstract static function runTests();

  public static function runAllTests(): string {
    $accumulatedTests = '';
    $accumulatedTests .= CircleTests::runTests();
    $accumulatedTests .= SquareTests::runTests();
    $accumulatedTests .= UserTests::runTests();
    $accumulatedTests .= ShapesCollectionTests::runTests();

    return $accumulatedTests;
  }
}
