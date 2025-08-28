<?php

use \App\Geometry\Shape;
use \App\Enums\Shapes;

$lengthSquare = Shape::create(Shapes::SQUARE, ['length' => '5']);

$squareTestNumber = 0;

$generateSquareTestText = function(Shape $squareObject, ?string $input = null) use (&$squareTestNumber) {
  $squareTestNumber++;
  return <<< SQUARE_TEST
  Square $squareTestNumber, input >> $input
    Length: $squareObject->length
    Diagonal: $squareObject->diagonal
    Perimeter: $squareObject->perimeter
    Area: $squareObject->area
  ---
  SQUARE_TEST;
};

$lengthSquareTest = $generateSquareTestText($lengthSquare, 'length = 5');

print <<< SQUARE_TESTS
----------SQUARE_TESTS-----------
$lengthSquareTest
SQUARE_TESTS . PHP_EOL;
