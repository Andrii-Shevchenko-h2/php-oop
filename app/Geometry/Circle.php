<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

readonly class Circle extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Formulas\SetValues;
  use \App\Geometry\Formulas\CircleFormulas;

  public Number $diameter;
  public Number $radius;
  public Number $area;
  public Number $circumference;

  public function __construct(private array $inputArray) {
    parent::__construct();

    $parameters = [
        ['diameter'],
        ['radius'],
        ['circumference'],
        ['area'],
    ];

    $this->validate(
      inputArray: $inputArray,
      validArrayKeys: $parameters,
    );

    $key = array_key_first($inputArray);

    $this->{$key} = new Number($inputArray[$key]);

    $this->setRemainingValues($this->getCircleFormulas());

  }
}
