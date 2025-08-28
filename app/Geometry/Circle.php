<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

readonly class Circle extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Consts;
  use \App\Geometry\FormulasSetValues;

  public private(set) Number $diameter;
  public private(set) Number $radius;
  public private(set) Number $area;
  public private(set) Number $circumference;
  public private(set) Number $pi;
  public private(set) Number $two;

  public function __construct(private array $inputArray) {
    $parameters = [
        ['diameter'],
        ['radius'],
        ['circumference'],
        ['area'],
    ];

    $this->setPi();
    $this->setTwo();
    $this->validate(
      inputArray: $inputArray,
      validArrayKeys: $parameters,
    );

    $circleFormulas = [
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

    $key = array_key_first($inputArray);

    $this->{$key} = new Number($inputArray[$key]);

    $this->setRemainingValues($circleFormulas);

  }
}
