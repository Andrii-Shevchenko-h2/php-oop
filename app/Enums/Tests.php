<?php

declare(strict_types=1);

namespace App\Enums;

use \App\Exceptions\AppException;

enum Tests: string
{
  private const TESTS_NAMESPACE = '\\App\\Tests';

  case CIRCLE = 'Circle';
  case SQUARE = 'Square';
  case USER = 'User';
  case SHAPES_COLLECTION = 'ShapesCollection';

  public static function getTestClass(Tests $test)
  {
    return self::TESTS_NAMESPACE . '\\' . match ($test) {
      self::CIRCLE => 'CircleTests',
      self::SQUARE => 'SquareTests',
      self::USER => 'UserTests',
      self::SHAPES_COLLECTION => 'ShapesCollectionTests',
      default => AppException::unvalidTest($test->value),
    };
  }
}
