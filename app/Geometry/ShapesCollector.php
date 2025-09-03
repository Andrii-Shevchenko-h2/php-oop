<?php

declare(strict_types = 1);

namespace App\Geometry;

class ShapesCollector implements \IteratorAggregate {
  private int $index;

  public function __construct(private ShapesArray $shapesArray) {}

  public function getIterator() {
    return new \ArrayIterator($this->shapesArray->shapes);
  }
}
