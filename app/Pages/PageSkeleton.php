<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class PageSkeleton { // each method arg should be custom class
  protected string $head;
  protected string $body;
  protected string $close;

  final public function setHead(?string $lines = null): void {
    $this->head = <<< TOP
    <!DOCTYPE HTML>
    <html>
      <head lang='en'>
        <meta charset='UTF-8'>
        $lines
      </head>
    TOP;
  }

  final public function setBody(?string $lines = null): void {
    $this->body = <<< BODY
    <body>
      $lines;
    BODY;
  }

  final public function closeHTML(?string $lines = null): void {
    if (!isset($this->body)) {
      AppException::HtmlCreate('closeWithoutBody');
    }

    $this->close = <<< CLOSE_HTML
        $lines
      </body>
    </html>
    CLOSE_HTML;
  }

  final public function getHTML() {
    if (!isset($this->head)) {
      AppException::HtmlCreate('headNotSet');
    } elseif (!isset($this->body)) {
      AppException::HtmlCreate('bodyNotSet');
    }

    return $this->head . $this->body;
  }
}
