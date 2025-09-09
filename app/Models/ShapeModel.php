<?php

declare(strict_types=1);

namespace App\Models;

use \BcMath\Number;
use \App\Geometry\BcNumbers;
use \App\Enums\Shapes;

final class ShapeModel
{
  public readonly array $parameters;
  public readonly array $formulas;
  public readonly array $data;

  public function __construct(Shapes $shape)
  {
    if ($shape === Shapes::CIRCLE) {
      $this->parameters = self::getCircleParameterKeys();
      $this->formulas = self::getCircleFormulas();
    }

    if ($shape === Shapes::SQUARE) {
      $this->parameters = self::getSquareParameterKeys();
      $this->formulas = self::getSquareFormulas();
    }
  }

  public function init(string $initialKey, Number $initialValue)
  {
    $this->data = $this->calculateData($initialKey, $initialValue);

    return $this;
  }

  private function calculateData(string $initialKey, Number $initialValue)
  {
    $tempdata = [$initialKey => $initialValue];

    foreach ($this->formulas as $formula) {

      if (isset($tempdata[$formula['result_key']])) {
        continue;
      }

      foreach ($formula['dependencies'] as $dependency) {
        if (!isset($tempdata[$dependency])) {
          continue 2;
        }
      }

      $tempdata[$formula['result_key']] = $formula['logic']($tempdata[$formula['dependencies'][0]]);
    }

    return $tempdata;
  }


  private static function getCircleParameterKeys()
  {
    return [
      ['circumference'],
      ['area'],
      ['diameter'],
      ['radius'],
    ];
  }

  private static function getCircleFormulas()
  {
    return [
      [
        'result_key' => 'diameter',
        'dependencies' => ['circumference'],
        'logic' => fn(Number $circumference): Number => $circumference / BcNumbers::getPi(),
      ],
      [
        'result_key' => 'radius',
        'dependencies' => ['area'],
        'logic' => fn(Number $area): Number => ($area / BcNumbers::getPi())->sqrt(),
      ],
      [
        'result_key' => 'radius',
        'dependencies' => ['diameter'],
        'logic' => fn(Number $diameter): Number => $diameter / BcNumbers::getTwo(),
      ],
      [
        'result_key' => 'diameter',
        'dependencies' => ['radius'],
        'logic' => fn(Number $radius): Number => $radius * BcNumbers::getTwo(),
      ],
      [
        'result_key' => 'circumference',
        'dependencies' => ['diameter'],
        'logic' => fn(Number $diameter): Number => BcNumbers::getPi() * $diameter,
      ],
      [
        'result_key' => 'area',
        'dependencies' => ['radius'],
        'logic' => fn(Number $radius): Number => $radius * $radius * BcNumbers::getPi(),
      ],
    ];
  }

  private static function getSquareParameterKeys()
  {
    return [
      ['length'],
      ['diagonal'],
      ['perimeter'],
      ['area'],
    ];
  }

  private function getSquareFormulas()
  {
    return [
      [
        'result_key' => 'length',
        'dependencies' => ['perimeter'],
        'logic' => fn(Number $perimeter): Number => $perimeter / BcNumbers::getFour(),
      ],
      [
        'result_key' => 'length',
        'dependencies' => ['diagonal'],
        'logic' => fn(Number $diagonal): Number => $diagonal / BcNumbers::getTwo()->sqrt()
      ],
      [
        'result_key' => 'length',
        'dependencies' => ['area'],
        'logic' => fn(Number $area): Number => $area->sqrt(),
      ],
      [
        'result_key' => 'diagonal',
        'dependencies' => ['length'],
        'logic' => fn(Number $length): Number => BcNumbers::getTwo()->sqrt() * $length,
      ],
      [
        'result_key' => 'perimeter',
        'dependencies' => ['length'],
        'logic' => fn(Number $length): Number => BcNumbers::getFour() * $length,
      ],
      [
        'result_key' => 'area',
        'dependencies' => ['length'],
        'logic' => fn(Number $length): Number => $length * $length,
      ],
    ];
  }
}
