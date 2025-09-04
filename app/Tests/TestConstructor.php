<?php

declare(strict_types = 1);

namespace App\Tests;

use \App\Geometry\Shape;
use \App\Enums\Tests;

readonly abstract class TestConstructor {
  public abstract static function runTests();

  public static function runAllTests(): string {
    $accumulatedTests = '';
    $accumulatedTests .= CircleTests::runTests();
    $accumulatedTests .= SquareTests::runTests();
    $accumulatedTests .= UserTests::runTests();
    $accumulatedTests .= ShapesCollectionTests::runTests();

    return $accumulatedTests;
  }

  public static function getDocumentForm(): string {
    $submitText = 'Try';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!isset($testName)) {
        $testName = $_POST['test-name'];
        $submitText = 'Create';
        $shapeEnum = Shape::getShapeEnum($testName);
        $shapeClass = Shape::getShapeClass($shapeEnum);
        $shapeParameters = $shapeClass::getParameterKeys();
      }

      if (isset($_POST['parameters'])) {
        $parameters = [
          $_POST['parameters'] => $_POST['parameter-value']
        ];
        $testClass = Tests::getTestClass(Tests::tryFrom($shapeEnum->value));

        return $testClass::createTest($parameters);
      }
    }

    $formStart = <<< START
    <form method="POST" action="">
      <label for='test-name'>Test name:</label><br>
      <input id='test-name' name='test-name' type='text' value='$testName'><br>
    START;

    $dropdownMenuOptions = '';

    foreach ($shapeParameters as $thisParameters) {
      foreach ($thisParameters as $option) {
        $dropdownMenuOptions .= "<option value='$option'>$option</option>";
      }
    }

    if (isset($thisParameters)) {
      $dropdownMenu = <<< DROPDOWN
      <label for='parameters'>Choose parameter:</label><br>
      <select name='parameters' id='parameters'>
        $dropdownMenuOptions
      </select><br>
      DROPDOWN;

      $inputValue = <<< VALUE
      <label for='parameter-value'>Value:</label><br>
      <input id='parameter-value' name='parameter-value' type='number'><br>
      VALUE;
    }


    $formMiddle = <<< MIDDLE
    $dropdownMenu
    $inputValue
    MIDDLE;

    $formEnd = <<< END
      <input type='submit' value='$submitText'>
    </form>
    END;

    return $formStart. $formMiddle .$formEnd;
  }
}
