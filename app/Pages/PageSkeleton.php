<?php

declare(strict_types = 1);

namespace App\Pages;

readonly class PageSkeleton { // each method arg should be custom class
  protected string $head;
  protected string $body;
  protected string $bottom;
  public private(set) string $document;

  final public function createDocument(
    ?string $head = null,
    ?string $body = null,
    ?string $bottom = null,
  ): string {
    $this->setHead($head);
    $this->setBody($body);
    $this->closeDocument($bottom);
    $this->setDocument();

    return $this->document;
  }

  final protected function setHead(?string $lines = null): void {
    $this->head = <<< TOP
    <!DOCTYPE HTML>
    <html>
      <head lang='en'>
        <meta charset='UTF-8'>
        $lines
      </head>
    TOP;
  }

  final protected function setBody(?string $lines = null): void {
    $this->body = <<< BODY
    <body>
      $lines
    BODY;
  }

  final protected function closeDocument(?string $lines = null): void {
    if (!isset($this->body)) {
      AppException::HtmlCreate('closeWithoutBody');
    }

    $this->bottom = <<< CLOSE_DOCUMENT
        $lines
      </body>
    </html>
    CLOSE_DOCUMENT;
  }

  private function setDocument() {
    $this->document = $this->head . $this->body . $this->bottom;
  }
}
