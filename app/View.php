<?php

declare(strict_types=1);

namespace App;

use \App\Enums\Pages;

final readonly class View
{
  private function __construct(
    private array $viewFiles,
  ) {
    foreach ($viewFiles as $view) {
      include $view;
    }
  }

  public static function fetch(string $URI)
  {
    $page = Pages::tryPublic($URI) ?? Pages::NOT_FOUND;
    $allRequiredPages = Pages::pageDependencies($page);
    $allFilePaths = [];

    foreach ($allRequiredPages as $requiredPage) {
      $potentialFilePath = Pages::getFilePath($requiredPage);

      if (file_exists($potentialFilePath)) {
        $allFilePaths[] = $potentialFilePath;
      } else {
        $allFilePaths[] = Pages::getFilePath(Pages::NOT_SET);
      }
    }

    new self($allFilePaths);
  }

  public static function generateNavigationLinks()
  {
    $generateLink = fn(string $link, string $linkName): string => "<a href='$link'>$linkName</a>";

    $URI = explode('?', $_SERVER['REQUEST_URI'])[0];

    $currentPage = Pages::tryPublic($URI) ?? Pages::NOT_FOUND;

    $generatedCurrentPageLink = $generateLink('#', $currentPage->name);

    $pages = Pages::cases();

    $getValidRandomPage = function (array $allPages, object $currentPage) {
      do {
        $randomPage = $allPages[array_rand($allPages)];
      } while ($randomPage === $currentPage || !Pages::isPublic($randomPage));

      return $randomPage;
    };

    $randomPages = [];

    while (count($randomPages) < 2) {
      $randomPage = $getValidRandomPage($pages, $currentPage);

      if (!in_array($randomPage, $randomPages)) {
        $randomPages[] = $randomPage;
      }
    }

    $generatedRandomPageLinks = '';

    foreach ($randomPages as $randomPage) {
      $generatedRandomPageLinks .= $generateLink($randomPage->value, $randomPage->name);
    }

    return $generatedCurrentPageLink . $generatedRandomPageLinks;
  }
}
