<?php

/**
 * Dear future me
 *
 * I sincerely apologize for the logic contained within this file.
 *
 * I am fully aware that this view has taken on far too many responsibilities -
 * duties that rightfully belong to a router or a controller. This is an
 * egregious violation of the principle of separation of concerns, and for that,
 * I am truly sorry.
 *
 * It is a temporary solution, and I promise to refactor this into a proper
 * routing structure at the earliest possible opportunity.
 *
 * Sincerely,
 * Andrii
 */

declare(strict_types=1);

namespace App\Core;

use \App\Enums\Pages;
use \App\Constants\Paths;

final class View
{
  private function __construct(private array $viewFiles, $data = [], $redirect)
  {
    // $data will get passed

    foreach ($viewFiles as $view) {
      self::loadFile($view, $data, $redirect);
    }
  }

  private static function redirect($file)
  {
    if (str_starts_with($file, Paths::VIEWS_PATH)) {
      if (file_exists($file) || file_exists($file . '.php')) {
        $location = substr($file, strlen(Paths::VIEWS_PATH));
      } else {
        $location = Pages::NOT_FOUND;
      }
    } else {
      $location = $file;
    }

    header("Location: $location");
    exit;
  }

  private static function loadFile(string $file, array $data, bool $redirect)
  {
    if ($redirect) {
      self::redirect($file);
    } else {
      if (str_starts_with($file, Paths::VIEWS_PATH)) {
        include $file;
      } else {
        $possibleFile = Paths::VIEWS_PATH . $file;

        if (file_exists($possibleFile)) {
          include $possibleFile;
        } else {
          http_response_code(404);
          print '<br><span style="color: red">File not found</span><br>';
        }
      }
    }
  }

  public static function render(string|array $path, array $data = [], bool $redirect = false): void
  {
    if (is_string($path)) {
      $path = [$path];
    }

    new self($path, $data, $redirect);
  }
}
