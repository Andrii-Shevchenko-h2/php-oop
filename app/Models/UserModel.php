<?php

declare(strict_types=1);

namespace App\Models;

use \App\Enums\Names;
use \Random\Randomizer;
use \App\Constants\Countries;

readonly class UserModel
{
  use \App\Traits\PublicData;

  public private(set) string $mail;
  public private(set) ?\DateInterval $age;
  public private(set) array $data;

  public function __construct(
    public string $name,
    public \DateTimeImmutable $birthDate,
    public ?\DateTimeImmutable $joinDate,
    private ?\DateTimeZone $timezone,
  ) {
    $this->age = $this->getAge();
    $this->mail = $this->generateMail();
    $this->data = $this->getPublicData();
  }

  private function getTLD(?\DateTimeZone $timeZone): string
  {
    $timeZoneCountryCode = $timeZone->getLocation()['country_code'];

    return match (in_array($timeZoneCountryCode, Countries::COUNTRY_CODES)) {
      true => strtolower($timeZoneCountryCode),
      default => 'com',
    };
  }

  private function generateMail(): string
  {
    // random number for simulating "taken mails"
    $randomNumber = new Randomizer()->getInt(min: 1, max: 1532);
    $timeZone = $this->timeZone ?? new \DateTimeZone('UTC');

    $generatedMail = str_replace(' ', '_', strtolower($this->name)) . $randomNumber . '@mail.' . $this->getTLD($timeZone);

    return $generatedMail;
  }

  private function getAge(): \DateInterval
  {
    $dateNow = new \DateTimeImmutable();

    return date_diff($dateNow, $this->birthDate);
  }

  // only allow usernames that were already "created", kinda like login
  private function validateName(): void
  {
    try {
      Names::from($this->name);
    } catch (\ValueError) {
      AppException::badUserName($this->name);
    }
  }
}
