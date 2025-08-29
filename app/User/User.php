<?php

declare(strict_types=1);

namespace App\User;

use \App\Enums\Names;

readonly class User {
  use CalculateData;

  private function __construct(
    readonly public string $name,
    readonly public string $birthDate,
    readonly private ?string $joinDate,
    readonly private ?string $timeZone,
  ) {
    $this->setBirthDateObject();
    $this->setJoinDateObject();
    $this->setAge();
    $this->setGeneratedMail();
  }

  public static function create(string $name, string $birthDate, ?string $joinDate = null, ?string $timeZone = null) {
    try {
      Names::from($name);
      return new self($name, $birthDate, $joinDate, $timeZone);
    } catch (\ValueError) {
      throw new BadNameException($name);
    }
  }
}
