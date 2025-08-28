<?php

declare(strict_types=1);

namespace App\Ancient;

use \App\Ancient\Mail;
use \App\Enums\Names;

readonly class Customer {
  protected int $age;
  public Mail $mail;

  public function __construct(
    protected string $name,
    protected string $birthDate,
  ) {
    $this->age = $this->getAge();
    $this->mail = new Mail($name, $this->age);
  }

  public function getAge(): int {
    return new \DateTimeImmutable()->diff(new \DateTimeImmutable($this->birthDate))->y;
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
