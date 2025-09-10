<?php

declare(strict_types=1);

namespace App\FileManager;

use \App\View;
use \App\Constants\Paths;
use \App\Validators\FileName;

final class Uploader
{
  public static function upload(array $file)
  {
    FileName::validate($file['name']);

    self::uploadFile($file);

    View::render('success', redirect: true);
  }

  private static function uploadFile(array $file): void
  {
    move_uploaded_file(from: $file['tmp_name'], to: Paths::UPLOADS_PATH . basename($file['name']));
  }
}
