<?php

declare(strict_types = 1);

namespace App\Geometry;

use \BcMath\Number;

// BCMath Const-Numbers
trait Consts {
  final protected function setTwo() {
    $this->two = new Number('2');
  }

  final protected function setPi() {
    $this->pi = new Number('3.14159265358979323846264338327950288');
  }
}
