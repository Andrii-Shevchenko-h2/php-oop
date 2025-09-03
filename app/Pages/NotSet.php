<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class NotSet extends PageSkeleton {
  public function __construct() {
    $this->createDocument(body: 'The page is yet to be created. Try again in the future!');
    print $this->document;
  }
}
