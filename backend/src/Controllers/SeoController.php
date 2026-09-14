<?php

namespace App\Controllers;

use App\Core\Controller;
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
    public function robots(Request $request): void
    {
        header('Content-Type: text/plain; charset=utf-8');

        echo "User-agent: *\n";
        echo "Allow: /\n\n";
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
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            echo "  <url>\n";
            echo '    <loc>' . htmlspecialchars(Seo::absoluteUrl($url['path'])) . "</loc>\n";
            echo '    <changefreq>' . $url['changefreq'] . "</changefreq>\n";
            echo '    <priority>' . $url['priority'] . "</priority>\n";
            echo "  </url>\n";
        }

        echo '</urlset>';
    }
}
