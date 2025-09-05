<?php

declare(strict_types=1);

namespace App\Enums;

enum FileExtensions: string
{
  case JPG = 'jpg';
  case JPEG = 'jpeg';
  case PNG = 'png';
  case CSV = 'csv';
  case TXT = 'txt';
}
