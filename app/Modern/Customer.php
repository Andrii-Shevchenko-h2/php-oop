<?php

declare(strict_types=1);

namespace App\Modern;

class Customer {
  readonly public \App\Modern\Mail $mail;

  protected int $age {
    get => (new \DateTimeImmutable())->diff(new \DateTimeImmutable($this->birthDate))->y;
  }

  private function __construct(
    public private(set) string $name,
    readonly protected string $birthDate,
  ) {
    $this->mail = new \App\Modern\Mail($name, $this->age);
  }

  public static function create(string $name, string $birthDate) {
    if (\App\Enums\Names::tryFrom($name) === null) {
      echo "Name $name is not on the list, operation aborted";
      return null;
    } else {
      return new Customer($name, $birthDate);
    }
  }
}
