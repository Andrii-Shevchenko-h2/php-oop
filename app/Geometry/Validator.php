<?php

declare(strict_types = 1);

namespace App\Geometry;

trait Validator {
  protected function validate(
    array $args,
    array $allowedKeys = [], // TO-DO: accept eventually pairs of keys
    int $maxArgs
  ) {
    if (count($args) > $maxArgs) {
      throw new \InvalidArgumentException('The input array must contain exactly one key-value pair');
    }

    $key = array_key_first($args);

    if (!in_array($key, $allowedKeys)) {
      $readableAllowedKeys = implode(', ', $allowedKeys);
      throw new \InvalidArgumentException("Bad Key: only these keys are allowed: $readableAllowedKeys");
    }
  }
}
