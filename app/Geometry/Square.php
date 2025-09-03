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
  public array $data;

  public function __construct(private array $inputArray) {
    parent::__construct();

    $this->validate($inputArray, $this->getParameterKeys());

    $key = array_key_first($inputArray);

    $this->{$key} = new Number($inputArray[$key]); // init first value

    $this->setRemainingValues($this->getSquareFormulas()); // set rest
    $this->data = ['class' => @end(explode('\\', __CLASS__)), 'length' => $this->length, 'area' => $this->area, 'perimeter' => $this->perimeter, 'diagonal' => $this->diagonal];
  }
}
