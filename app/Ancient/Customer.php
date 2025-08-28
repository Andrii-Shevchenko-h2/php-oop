<?php

declare(strict_types=1);

namespace App\Ancient;

require_once(__DIR__ . '/Mail.php');

readonly class Customer {
  protected int $age;
  public \App\Ancient\Mail $mail;

  public function __construct(
    protected string $name,
    protected string $birthDate,
  ) {
    $this->age = $this->getAge();
    $this->mail = new \App\Ancient\Mail($name, $this->age);
  }

  public function getAge(): int {
    return new \DateTimeImmutable()->diff(new \DateTimeImmutable($this->birthDate))->y;
  }
}
