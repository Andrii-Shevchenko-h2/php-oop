<?php

declare(strict_types = 1);

namespace App\Exceptions;

class AppException {
  public static function invalidTestParameterURI(?string $parameter = null): void {
    $info = <<< invalidParameterURI
    Excusest me sire, thou hast entered an invalid test URI parameter < $parameter >
    invalidParameterURI;

    self::generateException($info);
    exit(202);
  }

  public static function badShapeParameterValue(?string $value = null): void {
    $info = <<< badShapeValue
    Excusest me sire, thou hast inputted a bad shape parameter value < $value >
    badShapeValue;

    self::generateException($info);
    exit(205);
  }

  public static function badShapeParameterKey(?string $key = null): void {
    $info = <<< badShapeKey
    Excusest me sire, thou hast inputted a bad shape parameter key < $key >
    badShapeKey;

    self::generateException($info);
    exit(204);
  }

  public static function pageNotSet(?string $page = null): void {
    $info = <<< pageNotSet
    Excusest me sire, thou hast accessedeth a valid page that hath yet to be created
    Visitest < $page > sometime in the future!
    pageNotSet;

    self::generateException($info);
    exit(200);
  }

  public static function shapeClassNotSet(?string $shape = null): void {
    $info = <<< shapeClassNotSet
    Excusest me sire, thou hast inputted a correct shape
    However we are yet to treat it in any way, shape or form < $shape >
    shapeClassNotSet;

    self::generateException($info);
    exit(210);
  }

  public static function badShape(?string $shape = null): void {
    $info = <<< badShape
    Excusest me sire, thou hast inputted a shape that has is outright wrong < $shape >
    badShape;

    self::generateException($info);
    exit(210);
  }

  public static function badInstance(
    object $inputInstance,
    ?string $expectedInstance = null,
  ): void {
    $parsedGoodInstance = '';

    if (isset($expectedInstance)) {
      $parsedGoodInstance = "instead thou shallt opt to the recommended option $expectedInstance";
    }

    $info = <<< goodBadInstance
    Excusest me sire, thou hast usedeth a bad instance,
    $parsedGoodInstance
    goodBadInstance;

    self::generateException($info);
    exit(200);
  }

  private static function generateException(?string $info = null): void {
    $msgHead = self::getColorString('Oh dio! A horrendous exception hath occured!', 'errorHead');
    $message = <<< divineErrorMessage
    Thine divine message iseth:
    -> $info
    May lord have mercy? MAY LORD HAVE MERCY!!!
    divineErrorMessage . PHP_EOL;

    print $msgHead . PHP_EOL . (self::getColorString($message));
  }

  private static function getColorString(string $str, ?string $mode = null) {
    if (!isset($_SERVER['REQUEST_URI'])) {
      $color = match($mode) {
        'errorHead' => ["\033[41m" . "\033[30m", "\033[0m"],
        default => ["\033[31m", "\033[0m"],
      };
    } else {
      $color = ['<span style="color: red">', '</span>'];
      $str = nl2br($str);
    }

    return $color[0] . $str . $color[1];
  }
}
