<?php

use App\Controllers\Api\AuthController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\ImmigrationFeatureController;
use App\Controllers\ImmigrationRequestController;
use App\Controllers\PageController;
use App\Controllers\PoleController;

/** @var App\Core\Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/a-propos', [PageController::class, 'about']);
$router->get('/poles-expertise', [PageController::class, 'services']);
$router->get('/poles-expertise/immigration-etudes-france/candidature', [ImmigrationRequestController::class, 'index']);
$router->post('/poles-expertise/immigration-etudes-france/candidature', [ImmigrationRequestController::class, 'submit']);
$router->get('/poles-expertise/immigration-etudes-france/{feature}', [ImmigrationFeatureController::class, 'show']);
$router->get('/poles-expertise/{slug}', [PoleController::class, 'show']);
$router->get('/partenaires', [PageController::class, 'partners']);
$router->get('/engagement-social', [PageController::class, 'careers']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact', [ContactController::class, 'submit']);

$router->post('/api/register', [AuthController::class, 'register']);
$router->post('/api/login', [AuthController::class, 'login']);
