<?php

use App\Controllers\Api\AuthController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\PageController;

/** @var App\Core\Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/a-propos', [PageController::class, 'about']);
$router->get('/poles-expertise', [PageController::class, 'services']);
$router->get('/partenaires', [PageController::class, 'partners']);
$router->get('/engagement-social', [PageController::class, 'careers']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact', [ContactController::class, 'submit']);

$router->post('/api/register', [AuthController::class, 'register']);
$router->post('/api/login', [AuthController::class, 'login']);
