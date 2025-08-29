<?php

declare(strict_types = 1);

namespace App\User;

class BadNameException extends \Exception {
  public function __construct(private string $name) {
    parent::__construct(message: "Invalid name $this->name");
  }
}
