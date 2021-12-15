<?php

use Rendi\Rframework\Controllers\HomeController;
use Rendi\Rframework\Controllers\UserController;
use Rendi\Rframework\App\Core\Http\Router;
use Rendi\Rframework\Controllers\Test;


Router::get('/', [HomeController::class, 'index']);
Router::post('/', [HomeController::class, 'post']);
Router::get('/test/([a-z]*)', [Test::class, 'index']);
Router::get('/test', [Test::class, 'query']);

# route register
Router::get('/user/register', [UserController::class, 'register']);
Router::post('/user/register', [UserController::class, 'submitRegister']);
# route login
Router::get('/user/login', [UserController::class, 'login']);
Router::post('/user/login', [UserController::class, 'submitLogin']);

Router::get('/test/app/service', [UserController::class, 'test']);
