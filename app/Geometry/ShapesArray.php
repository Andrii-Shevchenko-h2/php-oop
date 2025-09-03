<?php

declare(strict_types = 1);

namespace App\Geometry;

use App\CustomExceptions\AppException;

readonly class ShapesArray {
  public function __construct(public private(set) array $shapes) {
    foreach ($shapes as $shape) {
      if (!$shape instanceof Shape) {
        throw AppException::badInstance($shape, 'Shape');
      }
    }
  }
}
