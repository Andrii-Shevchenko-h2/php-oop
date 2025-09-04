<?php

declare(strict_types = 1);

namespace App\Router;

use \App\Enums\Pages;
use \App\Exceptions\AppException;

readonly class Router {
  private const PAGES_NAMESPACE = '\\App\\Pages';

  public static function pullPage() {
    $URI_FULL = $_SERVER['REQUEST_URI'] ?? null;

    if (isset($URI_FULL)) {
      $URI = explode('?', $URI_FULL)[0];
    } else {
      $URI = '/debug';
    }

    $page = self::getPage($URI);
  }

  public static function getPage(string $URI) {
    $page = Pages::tryFrom($URI) ?? Pages::NOT_FOUND;
    $className = self::PAGES_NAMESPACE . '\\' . $page->getClassName($page);

    if (!class_exists(class: $className, autoload: true)) {
      $className = self::PAGES_NAMESPACE . '\\' . $page->getClassName(Pages::NOT_SET);
    }

    return new $className();
  }

}
