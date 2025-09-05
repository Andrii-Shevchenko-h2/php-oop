<?php

declare(strict_types=1);

namespace App\Geometry\Formulas;

use \App\Geometry\BcNumbers;

// I regret making this a trait and having entire Formulas directory
trait CircleFormulas
{
  use CircleParameterKeys;

  private function getCircleFormulas()
  {
    return [
      [
        'result_key' => 'diameter',
        'dependencies' => ['circumference'],
        'logic' => fn() => $this->circumference / BcNumbers::getPi(),
      ],
      [
        'result_key' => 'radius',
        'dependencies' => ['area'],
        'logic' => fn() => ($this->area / BcNumbers::getPi())->sqrt(),
      ],
      [
        'result_key' => 'radius',
        'dependencies' => ['diameter'],
        'logic' => fn() => $this->diameter / $this->two,
      ],
      [
        'result_key' => 'diameter',
        'dependencies' => ['radius'],
        'logic' => fn() => $this->radius * $this->two,
      ],
      [
        'result_key' => 'circumference',
        'dependencies' => ['diameter'],
        'logic' => fn() => $this->pi * $this->diameter,
      ],
      [
        'result_key' => 'area',
        'dependencies' => ['radius'],
        'logic' => fn() => $this->radius * $this->radius * $this->pi,
      ],
    ];
  }
}
