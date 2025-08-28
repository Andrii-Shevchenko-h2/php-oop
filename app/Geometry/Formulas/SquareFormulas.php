<?php

declare(strict_types = 1);

namespace App\Geometry\Formulas;

trait SquareFormulas {
  private function getSquareFormulas() {
    return [
      [
        'result_key' => 'length',
        'dependencies' => ['perimeter'],
        'logic' => fn() => $this->perimeter / $this->four,
      ],
      [
        'result_key' => 'length',
        'dependencies' => ['diagonal'],
        'logic' => fn() => $this->diagonal / $this->two->sqrt() 
      ],
      [
        'result_key' => 'length',
        'dependencies' => ['area'],
        'logic' => fn() => $this->area->sqrt(),
      ],
      [
        'result_key' => 'diagonal',
        'dependencies' => ['length'],
        'logic' => fn() => $this->two->sqrt() * $this->length,
      ],
      [
        'result_key' => 'perimeter',
        'dependencies' => ['length'],
        'logic' => fn() => $this->four * $this->length,
      ],
      [
        'result_key' => 'area',
        'dependencies' => ['length'],
        'logic' => fn() => $this->length * $this->length,
      ],
    ];
  }
}
