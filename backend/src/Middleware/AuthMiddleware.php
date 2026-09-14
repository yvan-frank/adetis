<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use App\Services\TokenService;

class AuthMiddleware
{
    public function handle(Request $request): void
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $token = $request->cookie($config['jwt']['cookie_name']) ?? $request->bearerToken();
        $isApi = str_starts_with($request->path, '/api/');

        if (!$token) {
            $isApi ? Response::json(['error' => 'Non authentifié'], 401) : Response::redirect('/connexion');
        }

        $payload = TokenService::verify($token);

        if (!$payload) {
            $isApi ? Response::json(['error' => 'Session invalide'], 401) : Response::redirect('/connexion');
        }

        $request->params['auth'] = $payload;
    }
}
