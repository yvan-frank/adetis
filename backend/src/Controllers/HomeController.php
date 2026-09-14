<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Seo;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('home', [
            'pageTitle' => 'ADETIS Engineering — Ingénierie, industrie & services associés',
            'pageDescription' => "Cabinet d'études en ingénierie, recherche appliquée, équipements industriels et formation, présent à Douala (Cameroun) et à Paris (France).",
            'activeNav' => 'home',
            'ogImage' => '/assets/img/hero-industry.jpg',
            'jsonLd' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => 'ADETIS Engineering',
                    'url' => Seo::baseUrl() . '/',
                ],
            ],
        ]);
    }
}
