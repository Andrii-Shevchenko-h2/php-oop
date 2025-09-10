<?php

declare(strict_types=1);

namespace App\Tests;

use \App\View;
use \App\Enums\Tests;
use \App\Enums\Shapes;
use \App\Geometry\ShapeModel;

abstract class TestConstructor
{
  public abstract static function runTests();

  public static function createForm(): void
  {
    session_start();

    self::handleRequest();

    $data = [
      'testName' => $_SESSION['testName'] ?? '',
      'submitText' => $_SESSION['submitText'] ?? 'Try',
      'shapeEnum' => $_SESSION['shapeEnum'] ?? null,
      'shapeClass' => $_SESSION['shapeClass'] ?? null,
      'shapeParameters' => $_SESSION['shapeParameters'] ?? null,
      'parameters' => $_SESSION['parameters'] ?? null,
      'testClass' => $_SESSION['testClass'] ?? null,
    ];

    View::render('tests/create.php', $data);
  }

  public static function handleRequest()
  {
    if (isset($_POST['new-test'])) {
      session_unset();
      session_destroy();
      header("Location: " . $_SERVER['REQUEST_URI']);
      exit;
    }

    if (!isset($_SESSION['testName']) && isset($_POST['test-name'])) {
      $tempTestName = $_POST['test-name'];
      $_SESSION['submitText'] = 'Create';
      $_SESSION['shapeEnum'] = Shapes::tryFrom($tempTestName);

      // Check if shapeEnum is null (invalid test name)
      if ($_SESSION['shapeEnum'] === null) {
        return View::render('helpers/error_paragraph.php', [
          'error' => 'Invalid test name. Please try again.'
        ]);
      }

      // If valid, set shape parameters
      $_SESSION['shapeParameters'] = new ShapeModel($_SESSION['shapeEnum'])->parameters;
      $_SESSION['testName'] = $tempTestName;
    }

    // Handle cases where testName exists but shapeParameters are missing
    if (isset($_SESSION['testName']) && !isset($_SESSION['shapeParameters'])) {
      return View::render('helpers/error_paragraph.php', [
        'error' => 'Invalid test name. Please try again.'
      ]);
    }

    if (!isset($_SESSION['parameters']) && isset($_POST['parameters'])) {
      $_SESSION['parameters'] = [$_POST['parameters'] => $_POST['parameter-value']];
      $_SESSION['testClass'] = Tests::getTestClass(Tests::tryFrom($_SESSION['shapeEnum']->value));
    }
  }
}
