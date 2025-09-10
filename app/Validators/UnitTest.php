<?php

declare(strict_types=1);

namespace App\Validators;

use \App\Exceptions\AppException;

final class UnitTest
{
  public static function validate(array $data)
  {
    foreach ($data as $dataKey => $dataValue) {
      if (!is_string($dataKey) || !is_string($dataValue)) {
        AppException::typeNotString();
      }
    }
  }
}
