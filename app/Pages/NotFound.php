<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class NotFound extends PageSkeleton {
  public function __construct() {
    $this->setHead();
    $this->setBody('Page not found');
    $this->closeHTML();
    print $this->head . $this->body . $this->close;
  }
}
