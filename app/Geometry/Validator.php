<?php

declare(strict_types = 1);

namespace App\Geometry;

trait Validator {
  protected function validate(
    array $args,
    array $allowedInputs = [],
  ) {
    $argsKeys = array_keys($args);

    if (!in_array($argsKeys, $allowedInputs)) {
      $readableAllowedKeys = implode(', ', $allowedInputs);
      throw new \InvalidArgumentException("Bad Key: only these keys are allowed: $readableAllowedKeys");
    }
  }
}
