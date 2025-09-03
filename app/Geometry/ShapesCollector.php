<?php

declare(strict_types = 1);

namespace App\Geometry;

class ShapesCollector implements \Iterator {
  private int $index;

  public function __construct(private ShapesArray $shapesArray) {}

  public function current() {
    $shape = $this->shapesArray->shapes[$this->index];
    return $shape;
  }

  public function next() {
    $this->index++;
  }

  public function key() {
    return $this->index;
  }

  public function rewind() {
    $this->index = 0;
  }

  public function valid() {
    return isset($this->shapesArray->shapes[$this->index]);
  }
}
