<?php

use Rendi\Rframework\App\Core\Http\Router;
use Rendi\Rframework\Controllers\HomeController;

$prefix = '/api';

Router::get("$prefix/home", [HomeController::class, 'api']);
Router::put("$prefix/home/([0-9]*)", [HomeController::class, 'putRequest']);
