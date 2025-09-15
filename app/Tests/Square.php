<?php

declare(strict_types=1);

namespace App\Tests;

use \App\Core\View;
use \App\Enums\Shapes;
use \App\Controllers\TestConstructor;
use \App\Controllers\ShapeCreator;

abstract class Square extends TestConstructor
{
  public static function runTests(): void
  {
    $lengthSquareTest = self::create(['length' => '5']);
    $diagonalSquareTest = self::create(['diagonal' => '5']);
    $perimeterSquareTest = self::create(['perimeter' => '5']);
    $areaSquareTest = self::create(['area' => '5']);
  }

  public static function create(array $input): void // model
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
