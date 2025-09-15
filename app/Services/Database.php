<?php

declare(strict_types=1);

namespace App\Services;

use \PDO;
use \App\Exceptions\AppException;

final class Database
{
  private static ?self $instance;
  private ?PDO $pdo;

  private function __construct()
  {
    $configFilePath = dirname(APP_ROOT) . '/private/settings/';
    $configFileName = 'my_settings.ini';

    if (!$config = parse_ini_file($configFilePath . $configFileName, TRUE)) AppException::unableToOpenConfigDB();

    $dns = (
      $config['database']['driver'] .
      ':host=' . $config['database']['host'] .
      ((!empty($config['database']['port'])) ? (';port=' . $config['database']['port']) : '') .
      ';dbname=' . $config['database']['schema']
    );

    try {
      $this->pdo = new PDO($dns, $config['database']['username'], $config['database']['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
    } catch (\PDOException) {
      AppException::badCredentialsDB();
    }
  }

  public static function getInstance(): self
  {
    return self::$instance ?? new self();
  }

  public function getConnection(): PDO
  {
    return $this->pdo;
  }

  // Prevent cloning the instance
  public function __clone() {}

  // Prevent unserializing the instance
  public function __wakeup() {}
}
