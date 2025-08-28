<?php

declare(strict_types=1);

namespace App\Ancient;

readonly class Mail {
  public string $address;

  public function __construct(
    private string $name,
    private int $age,
  ) {
    $this->address = $this->generateAddress();
  }

  private function generateAddress(): string {
    return str_replace(' ', '_', strtolower($this->name)) . $this->age . '@mail.co';
  }
}
