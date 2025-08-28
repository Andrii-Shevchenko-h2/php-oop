<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

readonly class Circle extends Shape {
  use \App\Geometry\Validator;

  public private(set) Number $diameter;
  public private(set) Number $radius;
  public private(set) Number $area;
  public private(set) Number $circumference;
  public private(set) Number $pi;
  public private(set) Number $two;

  public function __construct(private array $arg) {
    $this->setPi();
    $this->two = new Number('2');

    $this->validate(
      args: $arg,
      allowedInputs: [
        ['diameter'],
        ['radius'],
        ['circumference'],
        ['area'],
      ],
    );

    $key = array_key_first($arg);

    switch ($key) {
      case 'diameter':
        $this->diameter = new Number($arg[$key]);
        $this->setRadius();
        $this->setCircumference();
        $this->setArea();
        break;
      case 'radius':
        $this->radius = new Number($arg[$key]);
        $this->setDiameter();
        $this->setCircumference();
        $this->setArea();
        break;
      case 'circumference':
        $this->circumference = new Number($arg[$key]);
        $this->diameter = $this->circumference / $this->pi;
        $this->setRadius();
        $this->setArea();
        break;
      case 'area':
        $this->area = new Number($arg[$key]);
        $this->radius = ($this->area / $this->pi)->sqrt();
        $this->setDiameter();
        $this->setCircumference();
        break;
    }
  }

  protected function setPi() {
    $this->pi = new Number('3.14159265358979323846264338327950288');
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
