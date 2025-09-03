<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class Home extends PageSkeleton {
  public function __construct() {
    $this->setHead();
    $this->setBody('Welcome to Home page');
    $this->closeHTML();
    print $this->head . $this->body . $this->close;
  }
}
