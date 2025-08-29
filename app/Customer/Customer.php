<?php

declare(strict_types=1);

namespace App\Customer;

use \App\Enums\Names;

readonly class Customer {
  use CalculatedData;

  private function __construct(
    readonly public string $name,
    readonly public string $birthDate,
  ) {
    $this->setAge();
    $this->setMail();
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
