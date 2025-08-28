<?php

declare(strict_types = 1);

namespace App\Geometry;

use \App\Enums\Shapes;
use \BcMath\Number;

readonly abstract class Shape {
  /* abstract protected function calculateArea(): Number; */
  /* abstract protected function calculatePerimeter(): Number; */
  /* abstract protected function calculateCentroid(): Number; */

  final public static function create(
    Shapes $shape,
    array ...$constructArgs
  ): Shape {
    $className = '\\' . __NAMESPACE__ . '\\' . $shape->value;

    if (!class_exists(class: $className, autoload: true)) {
      throw new \LogicException("Unable to load class: $className");
    }

    return new $className(...$constructArgs);
  }
}
