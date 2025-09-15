<?php

declare(strict_types=1);

namespace App\Controllers;

use \BcMath\Number;
use \App\Enums\Shapes;
use \App\Models\ShapeModel;
use \App\Exceptions\AppException;
use \App\Validators\ShapeParameters;

readonly class ShapeCreator
{
  public array $data;

  final public function __construct(
    public Shapes $shape,
    array $parameters,
  ) {
    $newShape = new ShapeModel($shape);

    ShapeParameters::validate($parameters, $newShape->parameters);

    /* in future with more complex shapes, need here separate class */
    /* alternatively handle this better and not just grab first key */
    $key = array_key_first($parameters);

    try {
      $value = new Number($parameters[$key]);
    } catch (\ValueError) {
      AppException::badShapeParameterValue();
    }

    $this->data = $newShape->init($key, $value)->data;
  }
}
