<?php

namespace App\Core;

class Response
{
    public static function json(mixed $data, int $status = 200): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public static function redirect(string $to, int $status = 302): never
    {
        http_response_code($status);
        header("Location: $to");
        exit;
    }

    /**
     * Rend un template PHP natif dans le layout commun.
     *
     * La vue est rendue en premier (buffer capturé) afin que des variables
     * définies dans son propre fichier (ex: $pageTitle en tête de home.php)
     * soient disponibles dans le layout — notamment dans le <title> du
     * <head>, qui est émis AVANT que le corps de la page ne s'exécute.
     */
    public static function view(string $view, array $data = [], string $layout = 'layout'): void
    {
        $viewsPath = dirname(__DIR__) . '/Views';

        $vars = self::renderToVars("$viewsPath/$view.php", $data);
        $html = $vars['__html'];
        unset($vars['__html'], $vars['__file'], $vars['__data']);

        $vars['content'] = static function () use ($html) {
            echo $html;
        };

        extract($vars);
        require "$viewsPath/$layout.php";
    }

    private static function renderToVars(string $__file, array $__data): array
    {
        extract($__data);
        ob_start();
        require $__file;
        $__html = ob_get_clean();

        $vars = get_defined_vars();
        $vars['__html'] = $__html;

        return $vars;
    }
}
