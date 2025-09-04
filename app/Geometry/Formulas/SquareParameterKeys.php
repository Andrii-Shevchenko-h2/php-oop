<?php

declare(strict_types = 1);

namespace App\Geometry\Formulas;

trait SquareParameterKeys {
  readonly public array $parameters;

  public static function getParameterKeys() {
    return [
      ['length'],
      ['diagonal'],
      ['perimeter'],
      ['area'],
    ];
  }

  public function setParameters() {
    $this->parameters = self::getParameterKeys();
  }
}
