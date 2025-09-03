<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class NotSet extends PageSkeleton {
  public function __construct() {
    $this->setHead();
    $this->setBody('Page not set. Visit again in the future!');
    $this->closeHTML();
    print $this->head . $this->body . $this->close;
  }
}
