<?php

declare(strict_types = 1);

namespace App\Geometry;

trait Validator {
  protected function validate(
    array $inputArray,
    array $validArrayKeys,
  ) {
    $inputKeys = array_keys($inputArray);

    foreach ($inputArray as $inputValue) {
      if ($inputValue === null) {
        throw new \InvalidArgumentException("Bad Value: only non-null values are allowed");
      }
    }

    if (!in_array($inputKeys, $validArrayKeys)) {
      $readableAllowedKeys = '';

      foreach ($validArrayKeys as $keyPairArray) {
        $readableAllowedKeys .= '[';

        foreach ($keyPairArray as $singleKey) {
          $readableAllowedKeys .= $validArrayKey[0] . ', ';
        }

        $readableAllowedKeys .= ']';
      }

      throw new \InvalidArgumentException("Bad Key: only these keys are allowed: $readableAllowedKeys");
    }
  }
}
