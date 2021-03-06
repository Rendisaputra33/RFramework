<?php
require_once __DIR__ . '/../vendor/autoload.php';

\Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

use Rendi\Rframework\App\Core\Database\Database;

Database::getConnection(null);

require_once __DIR__ . './../app/bootstrap.php';
