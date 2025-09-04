<?php

declare(strict_types = 1);

namespace App\Tests;

use \App\Geometry\Shape;
use \App\Enums\Shapes;

readonly class SquareTests extends TestConstructor {
  public static function runTests(): string {
    $lengthSquareTest = self::createTest(['length' => '5']);
    $diagonalSquareTest = self::createTest(['diagonal' => '5']);
    $perimeterSquareTest = self::createTest(['perimeter' => '5']);
    $areaSquareTest = self::createTest(['area' => '5']);

    return <<< SQUARE_TESTS
    ----------SQUARE_TESTS-----------
    $lengthSquareTest
    $diagonalSquareTest
    $perimeterSquareTest
    $areaSquareTest
    SQUARE_TESTS . PHP_EOL;
  }

  public static function createTest(array $input): string {
    $squareObject = Shape::create(Shapes::SQUARE, $input);
    $inputString = key($input) . ' = ' . current($input);

    return <<< SQUARE_TEST
    Square input >> $inputString
      Length: $squareObject->length
      Diagonal: $squareObject->diagonal
      Perimeter: $squareObject->perimeter
      Area: $squareObject->area
    ---
    SQUARE_TEST;
  }
}
