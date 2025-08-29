<?php

declare(strict_types=1);

namespace App\Customer;

trait CalculatedData {
  readonly public private(set) int $age;
  readonly public private(set) string $mail;

  private function setAge() {
    $this->age = new \DateTimeImmutable()->diff(new \DateTimeImmutable($this->birthDate))->y;
  }

  private function setMail() {
    $this->mail = str_replace(' ', '_', strtolower($this->name)) . $this->age . '@mail.co';
  }
}
