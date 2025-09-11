<?php

use \App\Services\Database;

$db = Database::getInstance();

$pdo = $db->getConnection();
