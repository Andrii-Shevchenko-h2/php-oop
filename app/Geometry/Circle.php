<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;
use \App\Exceptions\AppException;

readonly class Circle extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Formulas\SetValues;
  use \App\Geometry\Formulas\CircleFormulas;

  public Number $diameter;
  public Number $radius;
  public Number $area;
  public Number $circumference;
  public array $data;

  public function __construct(private array $input) {
    parent::__construct();

    $this->setParameterKeys();

    $this->validate($input, $this->parameters);

    $key = array_key_first($input);

    try {
      $this->{$key} = new Number($input[$key]);
    } catch (\ValueError) {
      AppException::badShapeParameterValue($input[$key]);
    }

    $this->setRemainingValues($this->getCircleFormulas());
    $this->data = ['class' => @end(explode('\\', __CLASS__)), 'diameter' => $this->diameter, 'area' => $this->area, 'circumference' => $this->circumference, 'radius' => $this->radius];
  }
}
