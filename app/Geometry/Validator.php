<?php

declare(strict_types=1);

namespace App\Geometry;

trait Validator {
  private function validate(
    array $inputArray,
    array $validParameters,
  ): void {
    $inputKeys = array_keys($inputArray);

    foreach ($validParameters as $validKeyPair) {
      if ($inputKeys === $validKeyPair) {
        return;
      }
    }

    throw new \Exception('Invalid input parameters.');
  }
}

