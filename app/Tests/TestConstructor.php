<?php

declare(strict_types=1);

namespace App\Tests;

use \App\Geometry\Shape;
use \App\Enums\Tests;

readonly abstract class TestConstructor
{
  public abstract static function runTests();

  public static function runAllTests(): string
  {
    $accumulatedTests = '';
    $accumulatedTests .= CircleTests::runTests();
    $accumulatedTests .= SquareTests::runTests();
    $accumulatedTests .= UserTests::runTests();
    $accumulatedTests .= ShapesCollectionTests::runTests();

    return $accumulatedTests;
  }

  public static function getDocumentForm(): string
  {
    session_start();

    self::setFormValues();

    return self::generateForm();
  }

  public static function setFormValues()
  {
    if (isset($_POST['new-test'])) {
      session_unset();
      session_destroy();
      header("Location: " . $_SERVER['REQUEST_URI']);
    }

    if (!isset($_SESSION['testName']) && isset($_POST['test-name']) || isset($_GET['new'])) {
      if (isset($_POST['test-name'])) {
        $_SESSION['testName'] = $_POST['test-name'];
      } else {
        $_SESSION['testName'] = $_GET['new'];
      }
      $_SESSION['submitText'] = 'Create';
      $_SESSION['shapeEnum'] = Shape::getShapeEnum($_SESSION['testName']);
      $_SESSION['shapeClass'] = Shape::getShapeClass($_SESSION['shapeEnum']);
      $_SESSION['shapeParameters'] = $_SESSION['shapeClass']::getParameterKeys();
    }

    if (!isset($_SESSION['parameters']) && isset($_POST['parameters'])) {
      $_SESSION['parameters'] = [$_POST['parameters'] => $_POST['parameter-value']];
      $_SESSION['testClass'] = Tests::getTestClass(Tests::tryFrom($_SESSION['shapeEnum']->value));
    }
  }

  public static function generateForm(): string
  {
    $testName = $_SESSION['testName'] ?? '';
    $submitText = $_SESSION['submitText'] ?? 'Try';
    $shapeEnum = $_SESSION['shapeEnum'] ?? null;
    $shapeClass = $_SESSION['shapeClass'] ?? null;
    $shapeParameters = $_SESSION['shapeParameters'] ?? null;
    $parameters = $_SESSION['parameters'] ?? null;
    $testClass = $_SESSION['testClass'] ?? null;
    $dropdownAndInput = '';

    if (isset($shapeParameters)) {
      $dropdownMenuOptions = '';

      foreach ($shapeParameters as $thisParameters) {
        foreach ($thisParameters as $option) {
          $dropdownMenuOptions .= "<option value='$option'>$option</option>";
        }
      }

      $dropdownMenu = <<< DROPDOWN
      <label for='parameters'>Choose parameter:</label>
      <select name='parameters' id='parameters'>
        $dropdownMenuOptions
      </select>
      DROPDOWN;

      $setValue = <<< INPUT
      <label for='parameter-value'>Value:</label>
      <input id='parameter-value' name='parameter-value' type='number' min='0'>
      INPUT;

      $dropdownAndInput = <<< VALUES
      $dropdownMenu
      $setValue
      VALUES;
    }

    if (isset($parameters)) {
      $createdTest = nl2br($testClass::createTest($parameters));

      $form = <<< DOCUMENT
      <form method="POST" action="">
        <p><strong>{$shapeEnum->value}</strong> Test successfully created</p>
        $createdTest
        <button type='submit' name='new-test'>Create new test</button>
      </form>
      DOCUMENT;
    } else {
      $form = <<< DOCUMENT
      <form method="POST" action="">
        <label for='test-name'>Test name:</label>
        <input id='test-name' name='test-name' type='text' value='$testName'>
        $dropdownAndInput
        <input type='submit' value='$submitText'>
      </form>
      DOCUMENT;
    }

    return nl2br($form);
  }
}
