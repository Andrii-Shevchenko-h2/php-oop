<?php

declare(strict_types = 1);

namespace App\Geometry\Formulas;

trait CircleParameterKeys {
  readonly public array $parameters;

  public static function getParameterKeys() {
    return [
      ['circumference'],
      ['area'],
      ['diameter'],
      ['radius'],
    ];
  }

  public function setParameterKeys() {
    $this->parameters = self::getParameterKeys();
  }
}
