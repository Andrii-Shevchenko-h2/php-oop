<?php

declare(strict_types=1);

namespace App\Enums;

use \App\Constants\Namespaces;
use \App\Exceptions\AppException;

enum Tests: string
{
  case CIRCLE = 'Circle';
  case SQUARE = 'Square';
  case USER = 'User';
  case SHAPES_COLLECTION = 'ShapesCollection';

  public static function getTestClass(Tests $test)
  {
    return Namespaces::TESTS . '\\' . match ($test) {
      self::CIRCLE => 'Circle',
      self::SQUARE => 'Square',
      self::USER => 'User',
      self::SHAPES_COLLECTION => 'ShapesCollection',
      default => AppException::unvalidTest($test->value),
    };
  }
}
