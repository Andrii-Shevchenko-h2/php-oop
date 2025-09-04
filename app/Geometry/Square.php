<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;
use \App\Exceptions\AppException;

readonly class Square extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Formulas\SetValues;
  use \App\Geometry\Formulas\SquareFormulas;

  public Number $length;
  public Number $area;
  public Number $perimeter;
  public Number $diagonal;
  public array $data;

  public function __construct(private array $input) {
    parent::__construct();

    $this->setParameters();
    $this->validate($input, $this->parameters);

    $key = array_key_first($input);

    try {
      $this->{$key} = new Number($input[$key]);
    } catch (\ValueError) {
      AppException::badShapeParameterValue();
    }

    $this->setRemainingValues($this->getSquareFormulas()); // set rest
    $this->data = ['class' => @end(explode('\\', __CLASS__)), 'length' => $this->length, 'area' => $this->area, 'perimeter' => $this->perimeter, 'diagonal' => $this->diagonal];
  }
}
