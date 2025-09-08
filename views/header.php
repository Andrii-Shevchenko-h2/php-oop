<?php

declare(strict_types=1);

use \App\View;

?>
<!DOCTYPE html>
<html>

<head>
  <title>PHP OOP</title>
  <link rel="icon" href="/assets/media/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>

<body>
  <header>
    <nav class="navMenu">
      <p><a href='/'>PHP OOP Training</a></p>
      <?= View::generateNavigationLinks() ?>
    </nav>
  </header>
  <main>
