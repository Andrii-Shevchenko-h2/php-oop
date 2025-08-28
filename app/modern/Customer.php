<?php

declare(strict_types=1);

namespace App\Modern;

require_once(__DIR__ . '/Mail.php');

use App\Modern\Mail;

class Customer {
  readonly public Mail $mail;

  protected int $age {
    get => (new \DateTimeImmutable())->diff(new \DateTimeImmutable($this->birthDate))->y;
  }

  public function __construct(
    readonly public string $name,
    readonly public string $birthDate,
  ) {
    $this->mail = new Mail($name, $this->age);
  }
}
