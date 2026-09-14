<?php

/**
 * Routeur pour le serveur de dev intégré (`php -S localhost:8000 -t public
 * public/router.php`) UNIQUEMENT. Reproduit la logique de public/.htaccess
 * (fichier existant -> servi tel quel, sinon -> index.php) : sans ce script,
 * `php -S` sans routeur explicite sert bien les fichiers statiques mais ne
 * route pas les chemins sans extension (ex. /a-propos) vers index.php, et
 * inversement un routeur explicite sans cette logique casse le service des
 * assets statiques. Non utilisé en production (Apache + .htaccess).
 */

$path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
$file = __DIR__ . $path;

if ($path !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';
