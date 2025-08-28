<?php

declare(strict_types = 1);

namespace App\Geometry;

use \App\Enums\Shapes;

readonly abstract class Shape {
  use \App\Geometry\Consts;

  public function __construct() {
    $this->initializeConstants();
  }

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
