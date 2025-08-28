<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

// BCMath Const-Numbers
trait Consts {
  readonly public Number $two;
  readonly public Number $four;
  readonly public Number $pi;

  final protected function setTwo() {
    $this->two = new Number('2');
  }

  final protected function setFour() {
    $this->four = new Number('4');
  }

  final protected function setPi() {
    $this->pi = new Number('3.14159265358979323846264338327950288');
  }

  final protected function initializeConstants() {
    $this->setTwo();
    $this->setFour();
    $this->setPi();
  }
}
