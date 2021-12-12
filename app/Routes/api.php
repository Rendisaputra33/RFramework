<?php

use Rendi\Rframework\App\Core\Http\Router;
use Rendi\Rframework\Controllers\HomeController;


Router::middleware("api", function () {
    Router::get("/home", [HomeController::class, 'api']);
    Router::put("home/([0-9]*)", [HomeController::class, 'putRequest']);
});
