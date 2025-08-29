<?php

declare(strict_types=1);

namespace App\Customer;

class Mail {
  public string $address {
    get => str_replace(' ', '_', strtolower($this->name)) . $this->age . '@mail.co';
  }

  public function __construct(
    readonly private string $name,
    readonly private int $age,
  ) {}
}
