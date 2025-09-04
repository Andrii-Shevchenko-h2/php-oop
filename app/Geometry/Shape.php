<?php

declare(strict_types = 1);

namespace App\Geometry;

use \App\Enums\Shapes;
use \App\Exceptions\AppException;

readonly abstract class Shape {
  use \App\Geometry\Consts;

  public function __construct() {
    $this->initializeConstants();
  }

  final public static function create(
    Shapes $shape,
    array $parameters,
  ): Shape {
    $shapeClass = self::getShapeClass($shape);

    return new $shapeClass($parameters);
  }

  final public static function getShapeEnum(string $shape): Shapes {
    return Shapes::tryFrom($shape) ?? AppException::badShape($shape);
  }

  final public static function getShapeClass(Shapes $shape): string {
    $shapeClass = '\\' . __NAMESPACE__ . '\\' . $shape->value;

    if (!class_exists(class: $shapeClass, autoload: true)) {
      AppException::shapeClassNotSet($shape->value);
    }

    return $shapeClass;
  }
}
