<?php

declare(strict_types = 1);

namespace App\Pages;

interface RequestParser {
  public function getParser();
  public function postParser();
}
