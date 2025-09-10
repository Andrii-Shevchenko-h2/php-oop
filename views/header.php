<?php

declare(strict_types=1);

use \App\Core\View;

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
      <?php View::render('helpers/nav_link_generator.php') ?>
    </nav>
  </header>
  <main>
