<?php

declare(strict_types = 1);

namespace App\Tests;

use \App\User\User;

readonly class UserTests extends Tests {
  protected static function runTests() {
    $angelo = User::create(
      name: 'Angelo Merte',
      birthDate: '17.07.1954',
      joinDate: '27-06-2098 17:07',
      timeZone: 'Europe/Berlin',
    );
    $olaf = User::create(
      name: 'Olaf Holz',
      birthDate: '14.06.1958',
      joinDate: '19-04-1975 14:06',
    );
    $hercules = User::create(
      name: 'Hercules',
      birthDate: '12.08.1000',
      joinDate: '18-03-1985 12:08',
      timeZone: 'Europe/Athens',
    );

    $userNumber = 0;

    $generateuserTestText = function(User $user) use (&$userNumber) {
      $userNumber++;

      return <<< user_TEST
      user $userNumber
        Name: $user->name
        Birth Date: $user->birthDate
        Age: {$user->age->format('%y Years and %m Months')}
        Mail: $user->mail
        Member since: {$user->joinDateObject->diff($user->getNow())->format('%y Years, %m Months and %d Days')}
      ---
      user_TEST . print_r($user->joinDateObject);
    };

    $angeloTest = $generateuserTestText($angelo);
    $herculesTest = $generateuserTestText($hercules);
    $olafTest = $generateuserTestText($olaf);

    print <<< user_TESTS
    -----------user TESTS-------------
    $angeloTest
    $herculesTest
    $olafTest
    user_TESTS . PHP_EOL;
  }
}
