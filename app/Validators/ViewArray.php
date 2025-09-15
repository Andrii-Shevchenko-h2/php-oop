<?php

declare(strict_types=1);

namespace App\Validators;

use \App\Exceptions\AppException;

final class ViewArray
{
  public static function validate(array $data)
  {
    foreach ($data as $dataKey => $dataValue) {
      if (!is_string($dataKey) || !is_string($dataValue)) {
        var_dump($dataKey);
        var_dump($dataValue);
        AppException::typeNotString();
      }
    }
  }
}
