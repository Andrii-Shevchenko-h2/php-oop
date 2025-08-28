<?php

declare(strict_types=1);

namespace App\Modern;

use \App\Modern\Mail;
use \App\Enums\Names;

class Customer {
  readonly public Mail $mail;

  protected int $age {
    get => (new \DateTimeImmutable())->diff(new \DateTimeImmutable($this->birthDate))->y;
  }

  private function __construct(
    public private(set) string $name,
    readonly protected string $birthDate,
  ) {
    $this->mail = new Mail($name, $this->age);
  }

  public static function create(string $name, string $birthDate) {
    if (Names::tryFrom($name) !== null) {
      return new Customer($name, $birthDate);
    } else {
      echo "Name $name is not on the list, operation aborted";
      return null;
    }
  }
}
