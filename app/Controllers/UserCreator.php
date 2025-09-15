<?php

declare(strict_types=1);

namespace App\Controllers;

use \App\Enums\Names;
use \App\Models\UserModel;
use \App\Exceptions\AppException;

final readonly class UserCreator
{
  // use CalculateData
  public private(set) array $data;
  private ?\DateTimeZone $timeZoneObject;

  public function __construct(
    private string $name,
    private string $birthDate,
    private ?string $joinDate = null,
    private ?string $timeZone = null,
  ) {
    $this->timeZoneObject = $this->getTimeZoneObject();
    $birthDateObject = $this->getBirthDateObject();
    $joinDateObject = $this->getJoinDateObject();
    $this->data = new UserModel($name, $birthDateObject, $joinDateObject, $this->timeZoneObject)->data;
  }

  private function getTimeZoneObject(): ?\DateTimeZone
  {
    try {
      return $this->timeZone === null ? null : new \DateTimeZone($this->timeZone);
    } catch (\Throwable) {
      AppException::badTimeZone($this->birthDate);
    }
  }

  private function getFormattedDateObject(string $datetime)
  {
    try {
      $returnDate = \DateTimeImmutable::createFromFormat(format: 'd-m-Y G:i', datetime: $datetime, timezone: $this->timeZoneObject);

      if (!$returnDate) {
        throw new \Exception();
      }
    } catch (\Throwable) {
      AppException::badJoinDate($this->birthDate);
    }
  }

  private function getJoinDateObject(): ?\DateTimeImmutable
  {
    try {
      return $this->joinDate === null ? null : $this->getFormattedDateObject($this->joinDate);
    } catch (\Throwable) {
      AppException::badJoinDate($this->birthDate);
    }
  }

  private function getBirthDateObject(): \DateTimeImmutable
  {
    try {
      return new \DateTimeImmutable($this->birthDate);
    } catch (\Throwable) {
      AppException::badBirthDate($this->birthDate);
    }
  }
}
