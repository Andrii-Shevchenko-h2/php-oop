<?php

declare(strict_types = 1);

namespace App\CustomExceptions;

class AppException extends \Exception {
  public static function badInstance(
    mixed $inputInstance,
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

  private static function generateException(?string $additionalInfo = null): void {
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $file = $trace['file'] ?? 'unknown file';
    $line = $trace['line'] ?? 'unknown line';
    $parsedInfo = '';

    if (isset($additionalInfo)) {
      $parsedInfo = "Additional information iseth:\n>>> $additionalInfo";
    }

    $msgHead = self::getColorString('Oh dio! A horrendous exception hath occured!', 'errorHead');
    $message = <<< divineErrorMessage
    Thine divine message iseth:
    -> $parsedInfo
    The bewitched file iseth:
    -> $file
    The cursed line iseth:
    -> $line
    May lord have mercy? MAY LORD HAVE MERCY!!!
    divineErrorMessage . PHP_EOL;

    print $msgHead . PHP_EOL . (self::getColorString($message));
  }

  private static function getColorString(string $str, ?string $mode = null) {
    $color = match($mode) {
      'errorHead' => ["\033[41m" . "\033[30m", "\033[0m"],
      default => ["\033[31m", "\033[0m"],
};

    return $color[0] . $str . $color[1];
  }
}
