<?php

declare(strict_types=1);

namespace App;

use \App\Constants;

final readonly class View
{
  private function __construct(private array $viewFiles, $data = [])
  {
    foreach ($viewFiles as $view) {
      if (str_starts_with($view, Constants::VIEWS_PATH)) {
        include $view;
      } else {
        $possibleFile = Constants::VIEWS_PATH . $view;

        if (file_exists($possibleFile)) {
          include $possibleFile;
        } else {
          print 'File doesn\'t exist';
        }
      }
    }
  }

  public static function render(string|array $path, array $data = []): void
  {
    if (is_string($path)) {
      $path = [$path];
    }

    new self($path, $data);
  }
}
