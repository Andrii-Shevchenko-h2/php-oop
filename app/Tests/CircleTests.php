<?php

declare(strict_types = 1);

namespace App\Tests;

use \App\Geometry\Shape;
use \App\Enums\Shapes;

readonly class CircleTests extends TestConstructor {
  public static function runTests(): string {
    $radiusCircleTest = self::createTest(['radius' => '5']);
    $diameterCircleTest = self::createTest(['diameter' => '5']);
    $circumferenceCircleTest = self::createTest(['circumference' => '5']);
    $areaCircleTest = self::createTest(['area' => '5']);

    return <<< CIRCLE_TESTS
    ----------CIRCLE_TESTS-----------
    $radiusCircleTest
    $diameterCircleTest
    $circumferenceCircleTest
    $areaCircleTest
    CIRCLE_TESTS . PHP_EOL;
  }

  public static function createTest(array $input) {
    $circleObject = Shape::create(Shapes::CIRCLE, $input);
    $inputString = key($input) . ' = ' . current($input);

    return <<< CIRCLE_TEST
    Circle input >> $inputString
      Radius: $circleObject->radius
      Diameter: $circleObject->diameter
      Circumference: $circleObject->circumference
      Area: $circleObject->area
    ---
    CIRCLE_TEST;
  }
}
