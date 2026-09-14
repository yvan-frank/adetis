<?php

namespace App\Core;

/**
 * Bascule automatique entre le serveur de dev Vite (HMR, aucun build manuel
 * requis — port 5173 par défaut, `npm run dev` dans frontend/) et le bundle
 * statique buildé (`public/assets/islands-runtime.js`, via `npm run build`)
 * pour les environnements où ce serveur ne tourne pas (APP_ENV != local).
 */
class Assets
{
    public static function islandsTags(): string
    {
        Env::load(dirname(__DIR__, 2) . '/.env');

        if (Env::get('APP_ENV', 'local') === 'local') {
            // Basé sur l'hôte de la requête (pas "localhost" en dur) pour que
            // ça fonctionne aussi depuis un autre appareil du réseau local
            // (ex. test sur téléphone via l'IP LAN) sans configuration à part.
            $host = explode(':', $_SERVER['HTTP_HOST'] ?? 'localhost')[0];
            $vitePort = Env::get('VITE_DEV_PORT', '5173');
            $devServer = "http://{$host}:{$vitePort}";
            // Le HTML est servi par PHP, pas par Vite lui-même : le hook
            // transformIndexHtml() de @vitejs/plugin-react (qui injecte
            // normalement ce préambule React Refresh dans <head>) ne
            // s'exécute donc jamais. Sans lui, le premier module chargé
            // échoue avec "can't detect preamble" — on le reproduit à la main.
            return sprintf(
                '<script type="module">' .
                    'import RefreshRuntime from "%1$s/@react-refresh";' .
                    'RefreshRuntime.injectIntoGlobalHook(window);' .
                    'window.$RefreshReg$ = () => {};' .
                    'window.$RefreshSig$ = () => (type) => type;' .
                    'window.__vite_plugin_react_preamble_installed__ = true;' .
                '</script>' . "\n" .
                '<script type="module" src="%1$s/@vite/client"></script>' . "\n" .
                '<script type="module" src="%1$s/src/main.jsx"></script>',
                $devServer
            );
        }

        $mtime = @filemtime(dirname(__DIR__, 2) . '/public/assets/islands-runtime.js') ?: time();

        return sprintf('<script type="module" src="/assets/islands-runtime.js?v=%d" onerror="this.remove()"></script>', $mtime);
    }
}
