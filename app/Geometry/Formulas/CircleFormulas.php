<?php

declare(strict_types = 1);

namespace App\Geometry\Formulas;

trait CircleFormulas {
  final protected function getCircleFormulas() {
    return [
      [
        'result_key' => 'diameter',
        'dependencies' => ['circumference'],
        'logic' => fn() => $this->circumference / $this->pi,
      ],
      [
        'result_key' => 'radius',
        'dependencies' => ['area'],
        'logic' => fn() => ($this->area / $this->pi)->sqrt(),
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
