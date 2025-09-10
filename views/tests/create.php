<?php

// I'm sorry for this

$testName = $data['testName'] ?? '';
$submitText = $data['submitText'] ?? 'Try';
$shapeEnum = $data['shapeEnum'] ?? null;
$shapeClass = $data['shapeClass'] ?? null;
$shapeParameters = $data['shapeParameters'] ?? null;
$parameters = $data['parameters'] ?? null;
$testClass = $data['testClass'] ?? null;
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

print nl2br($form);
