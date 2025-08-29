<?php

declare(strict_types=1);

namespace App\User;

use \DateInterval;
use \DateTimeImmutable;
use \DateTimeZone;

trait CalculateData {
  use AllCountries;

  readonly public private(set) DateInterval $age;
  readonly public private(set) string $mail;
  readonly public private(set) DateTimeImmutable $birthDateObject;
  readonly public private(set) DateTimeImmutable $joinDateObject;

  public function getNow(): DateTimeImmutable {
    return new DateTimeImmutable();
  }

  private function setBirthDateObject(): void {
    $this->birthDateObject = new DateTimeImmutable($this->birthDate);
  }

  private function setJoinDateObject(): void {
    if ($this->joinDate !== null) {
      $timeZone = $this->timeZone !== null ? new DateTimeZone($this->timeZone) : null;
      $this->joinDateObject = DateTimeImmutable::createFromFormat(datetime: $this->joinDate, timezone: $timeZone, format: 'd-m-Y G:i');
    }
  }

  private function getCountryCodeFromTimeZone(?DateTimeZone $timeZone) {
    $countries = $this->getAllCountries();
    $timeZoneCountryCode = $timeZone->getLocation()['country_code'];

    return match(in_array($timeZoneCountryCode, $countries)) {
      true => strtolower($timeZoneCountryCode),
      default => 'com',
    };
  }

  private function setGeneratedMail(): void {
    $randomNumber = new \Random\Randomizer()->getInt(min: 1, max: 1532);
    $timeZone = $this->joinDateObject->getTimeZone();

    $this->mail = str_replace(' ', '_', strtolower($this->name)) . $randomNumber . '@mail.' . $this->getCountryCodeFromTimeZone($timeZone);
  }

  private function setAge(): void {
    $this->age = date_diff($this->getNow(), $this->birthDateObject);
  }
}
