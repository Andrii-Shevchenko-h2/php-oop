<?php

declare(strict_types=1);

namespace App;

use \App\View;
use \App\Enums\StaticExtensions;


readonly abstract class Router
{
  final public static function parseURI()
  {
    $URI_FULL = $_SERVER['REQUEST_URI'] ?? null;

    if (isset($URI_FULL)) {
      $URI = explode('?', $URI_FULL)[0];
    } else {
      $URI = '/debug';
    }

    // Check if the request is for a static file
    if (self::isStaticFile($URI)) {
      self::serveStaticFile($URI);
      return;
    }

    // Handle normal routing
    View::fetch($URI);
  }

  private static function isStaticFile(string $uri): bool
  {
    // Extract the file extension
    $extension = pathinfo($uri, PATHINFO_EXTENSION);

    // Check if the extension matches a static file type
    return StaticExtensions::tryFrom($extension) === null ? false : true;
  }

  private static function serveStaticFile(string $uri): void
  {
    $filePath = APP_ROOT . '/public' . $uri;

    if (file_exists($filePath)) {
      // Serve the file with appropriate headers
      $mimeType = mime_content_type($filePath);
      header('Content-Type: ' . $mimeType);
      readfile($filePath);
    } else {
      // Return a 404 if the file doesn't exist
      http_response_code(404);
      echo 'File not found.';
    }
  }
}
