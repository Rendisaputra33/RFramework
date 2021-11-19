<?php

use Rendi\Rframework\Controllers\HomeController;
use Rendi\Rframework\App\Core\Http\Router;
use Rendi\Rframework\Controllers\Test;


Router::get('/', [HomeController::class, 'index']);
Router::post('/', [HomeController::class, 'post']);
Router::get('/test/([a-z]*)', [Test::class, 'index']);
Router::get('/test', [Test::class, 'query']);
