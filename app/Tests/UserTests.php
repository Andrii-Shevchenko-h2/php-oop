<?php

declare(strict_types=1);

namespace App\Tests;

use \App\Core\View;
use \App\User\UserCreator;

abstract class UserTests extends TestConstructor
{
  public static function runTests()
  {
    self::createTest([
      'Angelo Merte',
      '17.07.1954',
      '27-06-1958 17:07',
      'Europe/Berlin',
    ]);
    self::createTest([
      'Olaf Holz',
      '14.06.1958',
      '19-04-1975 14:06',
    ]);
    self::createTest([
      'Hercules',
      '12.08.1000',
      '18-03-1985 12:08',
      'Europe/Athens',
    ]);
  }

  public static function createTest(array $input)
  {
    $userData = new UserCreator(...$input)->data;

    View::render('tests/user.php', $userData);
  }
}
