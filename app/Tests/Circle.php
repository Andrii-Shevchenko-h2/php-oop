<?php

declare(strict_types=1);

namespace App\Tests;

use \App\Core\View;
use \App\Enums\Shapes;
use \App\Controllers\ShapeCreator;
use \App\Controllers\TestConstructor;

final class Circle extends TestConstructor
{
  public static function runTests(): void
  {
    $radiusCircleTest = self::create(['radius' => '5']);
    $diameterCircleTest = self::create(['diameter' => '5']);
    $circumferenceCircleTest = self::create(['circumference' => '5']);
    $areaCircleTest = self::create(['area' => '5']);
  }

  public static function create(array $input) // model
  {
    $circleData = new ShapeCreator(Shapes::CIRCLE, $input)->data;

    try {
      $inputString = key($input) . ' = ' . current($input);
    } catch (\Throwable) {
      $inputString = 'Multi-dimensional input preview not available';
    }

    View::render('tests/circle.php', ['circleData' => $circleData, 'inputString' => $inputString]);
  }
}
