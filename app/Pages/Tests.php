<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class Tests extends PageSkeleton {
  public function __construct() {
    $this->createDocument(body: 'Welcome to Tests!');
    print $this->document;
  }
}
