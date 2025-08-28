<?php

declare(strict_types = 1);

namespace App\Geometry;

trait Validator {
  protected function validate(
    array $args,
    array $allowedInputs = [],
  ) {
    $argsKeys = array_keys($args);

    foreach ($args as $argValue) {
      if ($argValue === null) {
        throw new \InvalidArgumentException("Bad Value: only non-null values are allowed");
      }
    }

    if (!in_array($argsKeys, $allowedInputs)) {
      $readableAllowedKeys = implode(', ', $allowedInputs);
      throw new \InvalidArgumentException("Bad Key: only these keys are allowed: $readableAllowedKeys");
    }
  }
}
