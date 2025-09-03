<?php

declare(strict_types = 1);

namespace App\Geometry\Formulas;

trait SetValues {
  protected function setRemainingValues(array $formulas) {
    foreach ($formulas as $formula) {
      if (isset($this->{$formula['result_key']})) {
        continue;
      }

      foreach ($formula['dependencies'] as $dependency) {
        if (!isset($this->{$dependency})) {
          continue 2;
        }
      }

      $this->{$formula['result_key']} = $formula['logic']();
    }
  }
}
