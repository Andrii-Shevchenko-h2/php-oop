<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class NotFound extends PageSkeleton {
  public function __construct() {
    $body = 'Page not found';
    $this->createDocument(body: $body);
    print $this->document;
  }
}
