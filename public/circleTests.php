<?php

use \App\Geometry\Shape;
use \App\Enums\Shapes;

$radiusCircle = Shape::create(Shapes::CIRCLE, ['radius' => '5']);
$diameterCircle = Shape::create(Shapes::CIRCLE, ['diameter' => '5']);
$circumferenceCircle = Shape::create(Shapes::CIRCLE, ['circumference' => '5']);
$areaCircle = Shape::create(Shapes::CIRCLE, ['area' => '5']);

$circleTestNumber = 0;

$generateCircleTestText = function(Shape $circleObject, ?string $input = null) use (&$circleTestNumber) {
  $circleTestNumber++;
  return <<< CIRCLE_TEST
  Circle $circleTestNumber, input >> $input
    Radius: $circleObject->radius
    Diameter: $circleObject->diameter
    Circumference: $circleObject->circumference
    Area: $circleObject->area
    Pi: $circleObject->pi
  ---
  CIRCLE_TEST;
};

$radiusCircleTest = $generateCircleTestText($radiusCircle, 'radius = 5');
$diameterCircleTest = $generateCircleTestText($diameterCircle, 'diameter = 5');
$circumferenceCircleTest = $generateCircleTestText($circumferenceCircle, 'circumference = 5');
$areaCircleTest = $generateCircleTestText($areaCircle, 'area = 5');

print <<< CIRCLE_TESTS
----------CIRCLE_TESTS-----------
$radiusCircleTest
$diameterCircleTest
$circumferenceCircleTest
$areaCircleTest
CIRCLE_TESTS . PHP_EOL;
