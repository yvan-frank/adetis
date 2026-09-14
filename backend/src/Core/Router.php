<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->add('POST', $path, $handler, $middleware);
    }

    public function put(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->add('PUT', $path, $handler, $middleware);
    }

    public function delete(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->add('DELETE', $path, $handler, $middleware);
    }

    private function add(string $method, string $path, callable|array $handler, array $middleware): void
    {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $this->toRegex($path),
            'keys' => $this->extractKeys($path),
            'handler' => $handler,
            'middleware' => $middleware,
        ];
    }

    private function toRegex(string $path): string
    {
        $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $path);

        return '#^' . $regex . '$#';
    }

    private function extractKeys(string $path): array
    {
        preg_match_all('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', $path, $matches);

        return $matches[1];
    }

    public function dispatch(Request $request): void
    {
        $this->redirectTrailingSlash($request);

        foreach ($this->routes as $route) {
            if ($route['method'] !== $request->method) {
                continue;
            }

            if (preg_match($route['pattern'], $request->path, $matches)) {
                foreach ($route['keys'] as $key) {
                    $request->params[$key] = $matches[$key];
                }

                foreach ($route['middleware'] as $middleware) {
                    (new $middleware())->handle($request);
                }

                $this->callHandler($route['handler'], $request);
                return;
            }
        }

        $this->notFound($request);
    }

    /** Un seul canonical simple : /chemin/ -> /chemin (GET uniquement, un POST redirigé perdrait son body). */
    private function redirectTrailingSlash(Request $request): void
    {
        if ($request->method !== 'GET') {
            return;
        }

        $path = $request->path;

        if ($path !== '/' && str_ends_with($path, '/')) {
            $target = rtrim($path, '/');
            $query = $request->query ? '?' . http_build_query($request->query) : '';
            Response::redirect($target . $query, 301);
        }
    }

    private function callHandler(callable|array $handler, Request $request): void
    {
        if (is_array($handler)) {
            [$class, $method] = $handler;
            (new $class())->$method($request);
            return;
        }

        $handler($request);
    }

    private function notFound(Request $request): never
    {
        if (str_starts_with($request->path, '/api')) {
            Response::json(['error' => 'Route introuvable'], 404);
        }

        http_response_code(404);
        Response::view('errors/404');
        exit;
    }
}
