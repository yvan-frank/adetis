<?php

namespace App\Core;

/**
 * Petites briques SEO/GEO partagées entre le layout et les contrôleurs :
 * URLs absolues, schéma Organization (répété sur chaque page pour les
 * moteurs IA qui ne suivent pas toujours les liens internes) et
 * constructeur de BreadcrumbList.
 */
class Seo
{
    public static function baseUrl(): string
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';

        return rtrim((string) $config['app']['url'], '/');
    }

    public static function absoluteUrl(string $path): string
    {
        return self::baseUrl() . '/' . ltrim($path, '/');
    }

    /** @return array<string, mixed> */
    public static function organizationJsonLd(): array
    {
        $base = self::baseUrl();

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'ADETIS Engineering',
            'alternateName' => "Applications des Développements des Techniques d'Ingénierie et Services Associés",
            'url' => self::absoluteUrl(Lang::url('/')),
            'logo' => $base . '/assets/img/logo-adetis.png',
            'email' => 'directeur.general@adetis-engineering.com',
            'department' => [
                [
                    '@type' => 'LocalBusiness',
                    'name' => t('seo.org.hq'),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'BP 12067',
                        'addressLocality' => 'Douala',
                        'addressCountry' => 'CM',
                    ],
                    'telephone' => '+237620224811',
                    'faxNumber' => '+237698585506',
                    'email' => 'directeur.general@adetis-engineering.com',
                ],
                [
                    '@type' => 'LocalBusiness',
                    'name' => t('seo.org.branch'),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => '3 rue de Tourtille',
                        'postalCode' => '75020',
                        'addressLocality' => 'Paris',
                        'addressCountry' => 'FR',
                    ],
                    'telephone' => '+33617921219',
                    'email' => 'dtakendo@yahoo.fr',
                ],
            ],
        ];
    }

    /**
     * @param array<int, array{name: string, path?: string}> $items Dernier élément sans 'path' = page courante.
     * @return array<string, mixed>
     */
    public static function breadcrumbJsonLd(array $items): array
    {
        $listItems = [];

        foreach ($items as $i => $item) {
            $entry = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
            ];

            if (!empty($item['path'])) {
                $entry['item'] = self::absoluteUrl(Lang::url($item['path']));
            }

            $listItems[] = $entry;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }
}
