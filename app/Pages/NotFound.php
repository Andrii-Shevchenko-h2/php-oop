<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class NotFound extends PageSkeleton {
  public function __construct() {
    $this->createDocument(body: 'Page not found');
    print $this->document;
  }
}
