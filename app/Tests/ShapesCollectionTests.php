<?php

declare(strict_types = 1);

namespace App\Tests;

use \App\Geometry\Shape;
use \App\Enums\Shapes;
use \App\Geometry\ShapesArray;
use \App\Geometry\ShapesCollector;
use \App\Geometry\Circle;
use \App\Geometry\Square;
use \BcMath\Number;

readonly class ShapesCollectionTests extends Tests {
  protected static function runTests(): void {
    $circle = Shape::create(Shapes::CIRCLE, ['radius' => '5']);
    $square = Shape::create(Shapes::SQUARE, ['perimeter' => '5']);

    $shapesArray = new ShapesArray([$circle, $square]);
    $shapesCollection = new ShapesCollector($shapesArray);

    $generateShapeTest = function(Shape $shape, int $testNumber): string {
      if ($shape instanceof Circle) {
        return <<<CIRCLE_TEST
        Shape $testNumber: Circle
        Radius: {$shape->radius->value}
        Diameter: {$shape->diameter->value}
        Circumference: {$shape->circumference->value}
        Area: {$shape->area->value}
        ---
        CIRCLE_TEST;
      } elseif ($shape instanceof Square) {
        return <<<SQUARE_TEST
        Shape $testNumber: Square
        Length: {$shape->length->value}
        Diagonal: {$shape->diagonal->value}
        Perimeter: {$shape->perimeter->value}
        Area: {$shape->area->value}
        ---
        SQUARE_TEST;
      }
      return '';
    };

    $output = '';
    $testNumber = 0;

    foreach ($shapesCollection as $shape) {
      $testNumber++;
      $output .= $generateShapeTest($shape, $testNumber);
    }

    print <<<SHAPE_TESTS
    ----------SHAPE_TESTS-----------
    $output
    SHAPE_TESTS . PHP_EOL;
  }
}
