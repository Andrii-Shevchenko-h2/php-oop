<?php

declare(strict_types=1);

namespace App\Customer;

use \App\Customer\Mail;
use \App\Enums\Names;

class Customer {
  readonly public Mail $mail;

  public int $age {
    get => (new \DateTimeImmutable())->diff(new \DateTimeImmutable($this->birthDate))->y;
  }

  private function __construct(
    readonly public string $name,
    readonly public string $birthDate,
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
