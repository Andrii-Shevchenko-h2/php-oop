<?php

declare(strict_types=1);

namespace App\Tests;

use \App\View;
use \App\Enums\Shapes;
use \App\Geometry\ShapeCreator;

readonly class CircleTests extends TestConstructor
{
  public static function runTests(): void
  {
    $radiusCircleTest = self::createTest(['radius' => '5']);
    $diameterCircleTest = self::createTest(['diameter' => '5']);
    $circumferenceCircleTest = self::createTest(['circumference' => '5']);
    $areaCircleTest = self::createTest(['area' => '5']);
  }

  public static function createTest(array $input)
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
