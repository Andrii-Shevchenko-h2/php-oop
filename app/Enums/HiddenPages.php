<?php

declare(strict_types=1);

namespace App\Enums;

use \App\Enums\Pages;

enum HiddenPages: string
{
  case HEADER = Pages::HEADER->value;
  case FOOTER = Pages::FOOTER->value;
  case DEBUG = Pages::DEBUG->value;
}
