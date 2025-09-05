<?php

declare(strict_types=1);

namespace App\Geometry;

use \BcMath\Number;

final class BcNumbers
{
  private static ?Number $two = null;
  private static ?Number $four = null;
  private static ?Number $pi = null;

  public static function getTwo()
  {
    return self::$two ??= new Number('2');
  }

  public static function getFour()
  {
    return self::$four ??= new Number('4');
  }

  public static function getPi()
  {
    return self::$pi ??= new Number('3.14159265358979323846264338327950288');
  }
}
