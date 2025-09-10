<?php

declare(strict_types=1);

namespace App\Validators;

use \App\Exceptions\AppException;

final class ShapeParameters
{
  public static function validate(
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
