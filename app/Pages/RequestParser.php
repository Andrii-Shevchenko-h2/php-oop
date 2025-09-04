<?php

declare(strict_types = 1);

namespace App\Pages;

interface RequestParser {
  public function parseGET();
  public function parsePOST();
}
