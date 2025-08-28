<?php

use \App\Geometry\Shape;
use \App\Enums\Shapes;

$lengthSquare = Shape::create(Shapes::SQUARE, ['length' => '5']);
$diagonalSquare = Shape::create(Shapes::SQUARE, ['diagonal' => '5']);
$perimeterSquare = Shape::create(Shapes::SQUARE, ['perimeter' => '5']);
$areaSquare = Shape::create(Shapes::SQUARE, ['area' => '5']);

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
$diagonalSquareTest = $generateSquareTestText($diagonalSquare, 'diagonal = 5');
$perimeterSquareTest = $generateSquareTestText($perimeterSquare, 'perimeter = 5');
$areaSquareTest = $generateSquareTestText($areaSquare, 'area = 5');

print <<< SQUARE_TESTS
----------SQUARE_TESTS-----------
$lengthSquareTest
$diagonalSquareTest
$perimeterSquareTest
$areaSquareTest
SQUARE_TESTS . PHP_EOL;
