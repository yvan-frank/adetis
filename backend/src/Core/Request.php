<?php

namespace App\Core;

class Request
{
    public string $method;
    public string $path;
    /** Chemin tel que reçu, préfixe de langue inclus. */
    public string $rawPath;
    public array $query;
    public array $body;
    public array $params = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $this->path = Lang::boot($this->rawPath);
        $this->query = $_GET;
        $this->body = $this->parseBody();
    }

    private function parseBody(): array
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        if (str_contains($contentType, 'application/json')) {
            $raw = file_get_contents('php://input');
            return json_decode($raw, true) ?? [];
        }

        // $_POST n'est peuplé par PHP que pour les requêtes POST classiques ;
        // PUT/PATCH/DELETE en form-urlencoded doivent être lus manuellement.
        if ($this->method !== 'GET' && $this->method !== 'POST') {
            parse_str(file_get_contents('php://input') ?: '', $parsed);
            return $parsed;
        }

        return $_POST;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->body[$key] ?? $this->query[$key] ?? $default;
    }

    public function param(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    public function cookie(string $key, mixed $default = null): mixed
    {
        return $_COOKIE[$key] ?? $default;
    }

    /**
     * REMOTE_ADDR uniquement : les en-têtes X-Forwarded-For/X-Real-IP sont
     * librement falsifiables par le client tant qu'aucun reverse proxy de
     * confiance n'est configuré ici.
     */
    public function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    public function bearerToken(): ?string
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (str_starts_with($header, 'Bearer ')) {
            return substr($header, 7);
        }

        return null;
    }

    public function file(string $key): ?array
    {
        $file = $_FILES[$key] ?? null;

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        return $file;
    }
}
