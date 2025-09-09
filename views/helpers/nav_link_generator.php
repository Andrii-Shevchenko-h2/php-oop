<?php

declare(strict_types=1);

use \App\Enums\Pages;

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

print $generatedCurrentPageLink . $generatedRandomPageLinks;
