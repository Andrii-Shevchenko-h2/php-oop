<?php

declare(strict_types=1);

namespace App\Enums;

use \App\Constants\Paths;
use App\Enums\HiddenPages;

enum Pages: string
{
  case HOME = '/';
  case TESTS = '/tests';
  case NOT_FOUND = '/404';
  case NOT_SET = '/notset';
  case DEBUG = '/debug';
  case HEADER = '/header';
  case FOOTER = '/footer';
  case UPLOAD = '/upload';
  case SUCCESS = '/success';
  case PHP_INFO = '/phpinfo';

  public static function getFilePath(Pages $page): string
  {
    // HERE is the root of all evil. This should link to controller!
    return Paths::VIEWS_PATH . strtolower($page->name) . '.php';
  }

  public static function pageDependencies(Pages $page): array
  {
    $dependencies = match ($page) {
      // fill this up if dependencies arise, or keep in this/other enum
      default => [$page],
    };

    return [self::HEADER, ...$dependencies, self::FOOTER];
  }

  public static function tryPublic(string $page): ?Pages
  {
    $pageObject = self::tryFrom($page);

    if ($pageObject->value === null || HiddenPages::tryFrom($pageObject->value) !== null) {
      return null;
    }

    return $pageObject;
  }

  public static function isPublic(Pages $page): bool
  {
    return self::tryPublic($page->value) !== null;
  }
}
