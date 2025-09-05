<?php

declare(strict_types=1);

namespace App\FileManager;

use \App\Exceptions\AppException;
use \App\Enums\FileExtensions;

final class Uploader
{
  private const UPLOADS_PATH = APP_ROOT . '/uploads';

  private function __construct(array $file)
  {
    self::uploadFile($file);
  }

  public static function upload(array &$file)
  {
    self::validateFilename($file['name']);

    new self($file);
  }

  private static function validateFilename(string $fileName): void
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

  private static function uploadFile(array &$file): void
  {
    move_uploaded_file(from: $file['tmp_name'], to: self::UPLOADS_PATH . '/' . basename($file['name']));

    echo 'File uploaded successfully!';
    unset($file['name']);
  }
}
