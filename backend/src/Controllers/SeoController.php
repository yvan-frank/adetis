<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;
use App\Core\Request;
use App\Core\Seo;

/**
 * robots.txt et sitemap.xml générés dynamiquement (plutôt que des fichiers
 * statiques dans public/) pour que les URLs restent correctes quel que soit
 * APP_URL, et pour que le sitemap suive automatiquement les pôles/étapes
 * Immigration définis dans PoleController / ImmigrationFeatureController.
 */
class SeoController extends Controller
{
    /**
     * Date de dernière revue éditoriale du contenu (à mettre à jour
     * manuellement lors d'un changement de contenu significatif) — utilisée
     * comme <lastmod> plutôt qu'une date générée à la volée, qui donnerait
     * une fausse impression de fraîcheur quotidienne à Google.
     */
    private const CONTENT_LAST_REVIEWED = '2026-09-14';

    public function robots(Request $request): void
    {
        header('Content-Type: text/plain; charset=utf-8');

        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /api/\n\n";
        echo 'Sitemap: ' . Seo::absoluteUrl('/sitemap.xml') . "\n";
    }

    public function sitemap(Request $request): void
    {
        $urls = [
            ['path' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['path' => '/a-propos', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/poles-expertise', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/partenaires', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/engagement-social', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['path' => '/contact', 'priority' => '0.5', 'changefreq' => 'yearly'],
            ['path' => '/poles-expertise/immigration-etudes-france/candidature', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach (PoleController::all() as $pole) {
            $urls[] = ['path' => '/poles-expertise/' . $pole['slug'], 'priority' => '0.8', 'changefreq' => 'monthly'];
        }

        foreach (ImmigrationFeatureController::all() as $feature) {
            $urls[] = ['path' => '/poles-expertise/immigration-etudes-france/' . $feature['slug'], 'priority' => '0.7', 'changefreq' => 'monthly'];
        }

        header('Content-Type: application/xml; charset=utf-8');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

        foreach ($urls as $url) {
            // Une entrée par langue, chacune référençant toutes les versions (hreflang).
            $langs = array_keys(Lang::supported());

            foreach ($langs as $code) {
                echo "  <url>
";
                echo '    <loc>' . htmlspecialchars(Seo::absoluteUrl(Lang::url($url['path'], $code))) . "</loc>
";

                if (count($langs) > 1) {
                    foreach ($langs as $alt) {
                        echo '    <xhtml:link rel="alternate" hreflang="' . $alt . '" href="' . htmlspecialchars(Seo::absoluteUrl(Lang::url($url['path'], $alt))) . "\"/>
";
                    }
                }

                echo '    <lastmod>' . self::CONTENT_LAST_REVIEWED . "</lastmod>
";
                echo '    <changefreq>' . $url['changefreq'] . "</changefreq>
";
                echo '    <priority>' . $url['priority'] . "</priority>
";
                echo "  </url>
";
            }
        }

        echo '</urlset>';
    }
}
