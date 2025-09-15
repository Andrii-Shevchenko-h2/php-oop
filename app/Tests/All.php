<?php

declare(strict_types=1);

namespace App\Tests;

use \App\Controllers\TestConstructor;

abstract class All extends TestConstructor
{
  public static function runTests(): void
  {
    Circle::runTests();
    Square::runTests();
    User::runTests();
  }
}
