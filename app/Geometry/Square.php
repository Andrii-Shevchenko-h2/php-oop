<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

readonly class Square extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Formulas\SetValues;
  use \App\Geometry\Formulas\SquareFormulas;

  public Number $length;
  public Number $area;
  public Number $perimeter;
  public Number $diagonal;

  public function __construct(private array $inputArray) {
    parent::__construct();

    $parameters = [
      ['length'],
      ['diagonal'],
      ['perimeter'],
      ['area'],
    ];

    $this->validate(
      inputArray: $inputArray,
      validArrayKeys: $parameters,
    );

    $key = array_key_first($inputArray);

    $this->{$key} = new Number($inputArray[$key]); // init first value

    $this->setRemainingValues($this->getSquareFormulas()); // set rest
  }
}
