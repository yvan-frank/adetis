<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/helpers.php';

use App\Core\Request;
use App\Core\Router;

$router = new Router();
require dirname(__DIR__) . '/src/routes.php';

// La connexion PDO est ouverte paresseusement, parfois au milieu du rendu
// d'une vue — on bufferise donc tout le dispatch pour pouvoir jeter un
// rendu partiel et afficher une page d'erreur propre si la base tombe en
// cours de route, plutôt qu'un mélange de HTML à moitié généré et d'un
// fatal PHP.
ob_start();

try {
    $router->dispatch(new Request());
} catch (\PDOException $e) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    error_log('[DB] ' . $e->getMessage());

    http_response_code(503);
    header('Retry-After: 20');
    require dirname(__DIR__) . '/src/Views/errors/database.php';
    exit;
}

ob_end_flush();
