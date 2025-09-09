<?php

declare(strict_types=1);

namespace App\Geometry;

use \App\Exceptions\AppException;

trait Validator
{
  private function validate(
    array $input,
    array $validParameters,
  ): void {
    $inputKeys = array_keys($input);

    foreach ($validParameters as $validKeyPair) {
      if ($inputKeys === $validKeyPair) {
        return;
      }
    }

    AppException::badShapeParameterKey(implode(',', $inputKeys));
  }
}
