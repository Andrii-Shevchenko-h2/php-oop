<?php

declare(strict_types=1);

namespace App\Controllers\Tests;

use \App\Core\View;
use \App\Enums\Shapes;
use \App\Controllers\Geometry\ShapeCreator;

abstract class SquareTests extends TestConstructor
{
  public static function runTests(): void
  {
    $lengthSquareTest = self::createTest(['length' => '5']);
    $diagonalSquareTest = self::createTest(['diagonal' => '5']);
    $perimeterSquareTest = self::createTest(['perimeter' => '5']);
    $areaSquareTest = self::createTest(['area' => '5']);
  }

  public static function createTest(array $input): void
  {
    $squareData = new ShapeCreator(Shapes::SQUARE, $input)->data;

    try {
      $inputString = key($input) . ' = ' . current($input);
    } catch (\Throwable) {
      $inputString = 'Multi-dimensional input preview not available';
    }

    View::render('tests/square.php', ['squareData' => $squareData, 'inputString' => $inputString]);
  }
}
