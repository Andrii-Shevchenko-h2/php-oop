<?php

declare(strict_types=1);

namespace App\Enums;

enum StaticExtensions: string
{
  case CSS = 'css';
  case JS = 'js';
  case ICO = 'ico';
  case PNG = 'png';
  case JPG = 'jpg';
  case JPEG = 'jpeg';
  case GIF = 'gif';
  case SVG = 'svg';
  case WEBP = 'webp';
}
