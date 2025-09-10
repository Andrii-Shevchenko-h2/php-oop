<?php

declare(strict_types=1);

namespace App\Traits;

trait PublicData
{
  private function getPublicData(): array
  {
    $reflection = new \ReflectionClass($this);
    $publicProperties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
    $data = [];

    foreach ($publicProperties as $property) {
      $propertyName = $property->getName();
      // 'data' property excluded to avoid a loop
      if ($propertyName !== 'data') {
        $data[$propertyName] = $property->getValue($this);
      }
    }

    return $data;
  }
}
