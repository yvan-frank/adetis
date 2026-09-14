<?php

use App\Controllers\Api\AuthController;
use App\Controllers\HomeController;

/** @var App\Core\Router $router */

$router->get('/', [HomeController::class, 'index']);

$router->post('/api/register', [AuthController::class, 'register']);
$router->post('/api/login', [AuthController::class, 'login']);
