<?php

declare(strict_types=1);

namespace App\Ancient;

require_once(__DIR__ . '/Mail.php');

use App\Ancient\Mail;

readonly class Customer {
  public int $age;
  public Mail $mail;

  public function __construct(
    public string $name,
    public string $birthDate,
  ) {
    $this->age = $this->getAge();
    $this->mail = new Mail($name, $this->age);
  }

  public function getAge(): int {
    return new \DateTimeImmutable()->diff(new \DateTimeImmutable($this->birthDate))->y;
  }
}
