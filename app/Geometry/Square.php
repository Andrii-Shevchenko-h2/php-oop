<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

readonly class Square extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Consts;
  use \App\Geometry\FormulasSetValues;

  public private(set) Number $length;
  public private(set) Number $area;
  public private(set) Number $perimeter;
  public private(set) Number $diagonal;
  public private(set) Number $two;
  public private(set) Number $four;

  public function __construct(private array $inputArray) {
    $parameters = [
      ['length'],
      ['diagonal'],
      ['perimeter'],
      ['area'],
    ];

    $this->setTwo();
    $this->four = $this->two * $this->two;
    $this->validate(
      inputArray: $inputArray,
      validArrayKeys: $parameters,
    );

    // requires perfect order
    $squareFormulas = [
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

    $key = array_key_first($inputArray);

    // initialize first value
    $this->{$key} = new Number($inputArray[$key]);

    $this->setRemainingValues(formulas: $squareFormulas);
  }
}
