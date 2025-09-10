<?php

declare(strict_types=1);

namespace App\Validators;

use \App\Enums\FileExtensions;
use \App\Exceptions\AppException;

final class FileName
{
  public static function validate(string $fileName): void
  {
    $checkName = fn(): bool => preg_match("`^[-0-9A-Z_\.]+$`i", $fileName) === 1 ? true : false;

    $checkNameLength = fn(): bool => mb_strlen($fileName, "UTF-8") < 225;

    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $checkExtension = fn(): ?FileExtensions => FileExtensions::tryFrom(strtolower($fileExtension));

    if (!$checkName()) {
      AppException::badFilename($fileName);
    }

    if (!$checkNameLength()) {
      AppException::longFilename($fileName);
    }

    if ($checkExtension() === null) {
      AppException::badFileExtension($fileExtension);
    }
  }
}
