<?php

namespace App\Controllers\Api;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Validator;
use App\Models\User;
use App\Services\PasswordHasher;
use App\Services\TokenService;

class AuthController extends Controller
{
    public function register(Request $request): void
    {
        $data = $request->body;

        $validator = (new Validator())
            ->required($data, 'email', 'Email')
            ->email($data, 'email', 'Email')
            ->required($data, 'password', 'Mot de passe');

        if ($validator->fails()) {
            $this->json(['errors' => $validator->errors()], 422);
        }

        if (User::findByEmail($data['email'])) {
            $this->json(['error' => 'Cet email est déjà utilisé.'], 409);
        }

        $id = User::create([
            'email' => $data['email'],
            'password_hash' => PasswordHasher::hash($data['password']),
        ]);

        $this->json(['id' => $id], 201);
    }

    public function login(Request $request): void
    {
        $data = $request->body;
        $user = User::findByEmail($data['email'] ?? '');

        if (!$user || !PasswordHasher::verify($data['password'] ?? '', $user['password_hash'])) {
            $this->json(['error' => 'Identifiants invalides'], 401);
        }

        $token = TokenService::issue(['sub' => $user['id']]);

        $config = require dirname(__DIR__, 3) . '/config/config.php';
        setcookie($config['jwt']['cookie_name'], $token, [
            'expires' => time() + 86400,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        $this->json(['token' => $token]);
    }
}
