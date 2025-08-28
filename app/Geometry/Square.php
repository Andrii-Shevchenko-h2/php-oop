<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

readonly class Square extends Shape {
  use \App\Geometry\Validator;
  use \App\Geometry\Consts;

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

    $formulas = [
      [
        'result_key' => 'length',
        'dependencies' => ['perimeter'],
        'logic' => fn() => $this->perimeter / $this->four,
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

    // initialize value
    switch ($key) {
      case 'length':
        $this->length = new Number($inputArray[$key]);
        break;
      case 'diagonal': // START WORKING FROM HERE TILL END
        $this->diagonal = new Number($inputArray[$key]);
        break;
      case 'perimeter':
        $this->perimeter = new Number($inputArray[$key]);
        break;
      case 'area':
        $this->area = new Number($inputArray[$key]);
        break;
    }

    $calcAll = function() use ($inputArray, $parameters, $formulas) {
      foreach ($formulas as $formula) {
        if (isset($this->{$formula['result_key']})) {
          continue;
        }

        foreach ($formula['dependencies'] as $dependency) {
          if (!isset($dependency)) {
            continue 2;
          }
        }

        $this->{$formula['result_key']} = $formula['logic']();
      }
    };

    $calcAll();

  }

  private function setDiameter() {
    $this->diameter = $this->radius * $this->two;
  }

  private function setRadius() {
    $this->radius = $this->diameter / $this->two;
  }

  private function setArea() {
    $this->area = $this->pi * $this->radius * $this->radius;
  }

  private function setCircumference() {
    $this->circumference = $this->pi * $this->diameter;
  }
}
