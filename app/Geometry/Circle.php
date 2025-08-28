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

  public function __construct(private array $arg) {
    $this->setPi();

    $allowedKeys = [
      'diameter',
      'radius',
      'circumference',
      'area',
    ];

    $this->validate(
      args: $arg,
      allowedKeys: $allowedKeys,
      maxArgs: 1
    );

    $key = array_key_first($arg);

    switch ($key) {
      case 'diameter':
        $this->diameter = new Number($arg[$key]);
        $this->radius = $this->diameter / new Number('2');
        $this->setCircumference();
        $this->setArea();
        break;
      case 'radius':
        $this->radius = new Number($arg[$key]);
        $this->diameter = $this->radius * new Number('2');
        $this->setCircumference();
        $this->setArea();
        break;
      case 'circumference':
        $this->circumference = new Number($arg[$key]);
        $this->diameter = $this->circumference / $this->pi;
        $this->radius = $this->diameter / 2;
        $this->setArea();
        break;
      case 'area':
        $this->area = new Number($arg[$key]);
        $radiusSquared = (string) ($this->area / $this->pi);
        $this->radius = new Number($radiusSquared)->sqrt();
        $this->diameter = $this->radius * new Number('2');
        $this->setCircumference();
        break;
    }
  }

  protected function setPi() {
    $this->pi = new Number('3.14159265358979323846264338327950288');
  }

  private function setArea() {
    $this->area = $this->pi * $this->radius * $this->radius;
  }

  private function setCircumference() {
    $this->circumference = $this->pi * $this->diameter;
  }

  /* public function calculateArea(): float { */
  /*   return $area ?? 5; */
  /* } */
  /**/
  /* public function calculatePerimeter(): float { */
  /*   return $circumference ?? 6; */
  /* } */
  /**/
  /* public function calculateCentroid(): float { */
  /*   return 7; */
  /* } */
}
