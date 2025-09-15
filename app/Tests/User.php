<?php

declare(strict_types=1);

namespace App\Tests;

use \App\Core\View;
use \App\Controllers\UserCreator;
use \App\Controllers\TestConstructor;

abstract class User extends TestConstructor
{
  public static function runTests()
  {
    self::create([
      'Angelo Merte',
      '17.07.1954',
      '27-06-1958 17:07',
      'Europe/Berlin',
    ]);
    self::create([
      'Olaf Holz',
      '14.06.1958',
      '19-04-1975 14:06',
    ]);
    self::create([
      'Hercules',
      '12.08.1000',
      '18-03-1985 12:08',
      'Europe/Athens',
    ]);
  }

  public static function create(array $input) // model
  {
    $userData = new UserCreator(...$input)->data;

    View::render('tests/user.php', $userData);
  }
}
