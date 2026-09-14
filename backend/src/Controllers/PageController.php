<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Seo;

class PageController extends Controller
{
    public function about(Request $request): void
    {
        $this->view('about', [
            'pageTitle' => 'À propos — ADETIS Engineering',
            'pageDescription' => "ADETIS, cabinet d'ingénierie basé à Douala et à Paris : vision, implantations et équipe dirigeante.",
            'activeNav' => 'about',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => 'Accueil', 'path' => '/'],
                    ['name' => 'À propos'],
                ]),
            ],
        ]);
    }

    public function services(Request $request): void
    {
        $this->view('services', [
            'pageTitle' => "Nos pôles d'expertise — ADETIS Engineering",
            'pageDescription' => "Bureau d'études CAO/DAO, recherche appliquée, Boostmarket, formation et immigration/études en France : les cinq pôles d'expertise d'ADETIS.",
            'activeNav' => 'services',
            'poles' => array_values(PoleController::all()),
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => 'Accueil', 'path' => '/'],
                    ['name' => "Nos pôles d'expertise"],
                ]),
            ],
        ]);
    }

    public function partners(Request $request): void
    {
        $this->view('partners', [
            'pageTitle' => 'Partenaires & Marchés — ADETIS Engineering',
            'pageDescription' => "Zones d'intervention et partenaires d'ADETIS en Afrique Centrale, en Europe et au-delà.",
            'activeNav' => 'partners',
            'ogImage' => '/assets/img/partnership-handshake.jpg',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => 'Accueil', 'path' => '/'],
                    ['name' => 'Partenaires & Marchés'],
                ]),
            ],
        ]);
    }

    public function careers(Request $request): void
    {
        $this->view('careers', [
            'pageTitle' => 'Engagement social — ADETIS Engineering',
            'pageDescription' => "L'engagement social d'ADETIS pour la formation et la réinsertion professionnelle de la jeunesse.",
            'activeNav' => 'careers',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => 'Accueil', 'path' => '/'],
                    ['name' => 'Engagement social'],
                ]),
            ],
        ]);
    }
}
