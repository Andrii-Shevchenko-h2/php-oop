<?php

declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));

require_once(APP_ROOT . '/vendor/autoload.php');

# Error reporting, because dev environment
ini_set('display_errors', 1);
error_reporting(E_ALL);

use \App\Core\Router;

Router::parseURI();
