<?php

use Rendi\Rframework\App\Core\Http\Router;

require_once __DIR__ . '/Routes/web.php';
require_once __DIR__ . '/Routes/api.php';

Router::run();
