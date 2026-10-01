<?php

namespace App\Core;

/**
 * Internationalisation par préfixe d'URL : le français (défaut) vit à la
 * racine (/a-propos), les autres langues sous /<code> (/en/a-propos). Les
 * slugs ne sont pas traduits : seul le préfixe change, ce qui permet de
 * déclarer chaque route une seule fois.
 *
 * Les segments d'URL sont traduits eux aussi : le routeur ne connaît que les
 * chemins français « internes » (/a-propos), boot() convertit un chemin
 * localisé (/en/about) vers cette forme et url() fait l'inverse. Les
 * correspondances vivent dans lang/<code>/routes.php (segment FR => segment).
 *
 * Les textes vivent dans lang/<code>.php et lang/<code>/*.php (tableaux
 * plats, clés pointées). Une clé manquante retombe sur le français, puis sur
 * la clé elle-même. Les contenus structurés (pôles, étapes Immigration) sont
 * surchargés champ par champ par lang/<code>/content/<nom>.php (voir overlay()).
 * Ajouter une langue = ajouter son code dans $supported + les fichiers lang/.
 */
class Lang
{
    public const DEFAULT = 'fr';

    /** @var array<string, string> code => locale Open Graph */
    private static array $supported = ['fr' => 'fr_FR', 'en' => 'en_US'];

    private static string $current = self::DEFAULT;

    /** Chemin de la requête sans préfixe de langue. */
    private static string $barePath = '/';

    /** @var array<string, array<string, string>> */
    private static array $catalogs = [];

    /** @var array<string, array<string, string>> */
    private static array $routeMaps = [];

    /**
     * Extrait le préfixe de langue d'un chemin et mémorise la langue active.
     *
     * @return string chemin sans préfixe ('/en/contact' -> '/contact', '/en' -> '/')
     */
    public static function boot(string $path): string
    {
        self::$current = self::DEFAULT;
        self::$barePath = $path;

        foreach (array_keys(self::$supported) as $code) {
            if ($code === self::DEFAULT) {
                continue;
            }

            if ($path === "/$code" || str_starts_with($path, "/$code/")) {
                self::$current = $code;
                $rest = substr($path, strlen($code) + 1);

                return self::$barePath = self::translatePath($rest === '' ? '/' : $rest, $code, true);
            }
        }

        return $path;
    }

    public static function current(): string
    {
        return self::$current;
    }

    public static function barePath(): string
    {
        return self::$barePath;
    }

    /** @return array<string, string> code => locale OG */
    public static function supported(): array
    {
        return self::$supported;
    }

    public static function locale(?string $lang = null): string
    {
        return self::$supported[$lang ?? self::$current];
    }

    /** URL interne d'un chemin sans préfixe, dans la langue donnée (défaut : courante). */
    public static function url(string $path, ?string $lang = null): string
    {
        $lang ??= self::$current;
        $path = '/' . ltrim($path, '/');

        if ($lang === self::DEFAULT) {
            return $path;
        }

        // Le chemin peut porter une query string ou un fragment : seul le chemin est traduit.
        $cut = strcspn($path, '?#');
        $suffix = substr($path, $cut);
        $path = self::translatePath(substr($path, 0, $cut), $lang, false);

        return ($path === '/' ? "/$lang" : "/$lang$path") . $suffix;
    }

    /**
     * Chemin localisé canonique de la requête courante (avec préfixe), ou
     * null si l'URL demandée est déjà la bonne. Sert à rediriger en 301
     * /en/a-propos vers /en/about.
     */
    public static function canonicalPath(string $rawPath): ?string
    {
        if (self::$current === self::DEFAULT) {
            return null;
        }

        $expected = self::url(self::$barePath);

        return $expected === $rawPath ? null : $expected;
    }

    /**
     * Traduit segment par segment un chemin interne (FR) vers la langue
     * donnée, ou l'inverse. Un segment inconnu est conservé tel quel.
     */
    private static function translatePath(string $path, string $lang, bool $toInternal): string
    {
        $map = self::routeMap($lang);

        if ($toInternal) {
            $map = array_flip($map);
        }

        $segments = array_map(
            static fn (string $segment): string => $map[$segment] ?? $segment,
            explode('/', $path)
        );

        return implode('/', $segments);
    }

    /** @return array<string, string> segment français => segment dans $lang */
    private static function routeMap(string $lang): array
    {
        $file = dirname(__DIR__, 2) . "/lang/$lang/routes.php";

        return self::$routeMaps[$lang] ??= is_file($file) ? require $file : [];
    }

    /**
     * Applique sur des données françaises (listées par clé) la surcharge de
     * la langue courante, lang/<code>/content/<name>.php. Seuls les champs
     * présents dans la surcharge sont remplacés ; les listes sont fusionnées
     * par position, elles doivent donc garder le même ordre.
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public static function overlay(array $data, string $name): array
    {
        if (self::$current === self::DEFAULT) {
            return $data;
        }

        $file = dirname(__DIR__, 2) . '/lang/' . self::$current . "/content/$name.php";

        return is_file($file) ? array_replace_recursive($data, require $file) : $data;
    }

    /**
     * Libellés traduits d'une liste de choix (valeurs de <select>).
     *
     * @param array<string, string> $choices clé => libellé français (valeur stockée en base)
     * @return array<string, string> clé => libellé dans la langue courante
     */
    public static function choices(string $prefix, array $choices): array
    {
        $out = [];

        foreach ($choices as $key => $frLabel) {
            $translated = self::t("$prefix.$key");
            $out[$key] = $translated === "$prefix.$key" ? $frLabel : $translated;
        }

        return $out;
    }

    public static function t(string $key, array $replace = []): string
    {
        $text = self::catalog(self::$current)[$key]
            ?? self::catalog(self::DEFAULT)[$key]
            ?? $key;

        foreach ($replace as $name => $value) {
            $text = str_replace('{' . $name . '}', (string) $value, $text);
        }

        return $text;
    }

    /** @return array<string, string> */
    private static function catalog(string $lang): array
    {
        return self::$catalogs[$lang] ??= (static function () use ($lang): array {
            $base = dirname(__DIR__, 2) . '/lang';
            $files = array_merge(["$base/$lang.php"], glob("$base/$lang/*.php") ?: []);
            $catalog = [];

            foreach ($files as $file) {
                if (is_file($file) && basename($file) !== 'routes.php') {
                    $catalog = array_merge($catalog, require $file);
                }
            }

            return $catalog;
        })();
    }
}
