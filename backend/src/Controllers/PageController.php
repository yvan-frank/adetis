<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class PageController extends Controller
{
    public function about(Request $request): void
    {
        $this->view('about', [
            'pageTitle' => 'À propos — ADETIS Engineering',
            'pageDescription' => "ADETIS, cabinet d'ingénierie basé à Douala et à Paris : vision, implantations et équipe dirigeante.",
            'activeNav' => 'about',
        ]);
    }

    public function services(Request $request): void
    {
        $this->view('services', [
            'pageTitle' => "Nos pôles d'expertise — ADETIS Engineering",
            'pageDescription' => "Bureau d'études CAO/DAO, recherche appliquée, Boostmarket, formation et immigration/études en France : les cinq pôles d'expertise d'ADETIS.",
            'activeNav' => 'services',
            'poles' => array_values(PoleController::all()),
        ]);
    }

    public function partners(Request $request): void
    {
        $this->view('partners', [
            'pageTitle' => 'Partenaires & Marchés — ADETIS Engineering',
            'pageDescription' => "Zones d'intervention et partenaires d'ADETIS en Afrique Centrale, en Europe et au-delà.",
            'activeNav' => 'partners',
        ]);
    }

    public function careers(Request $request): void
    {
        $this->view('careers', [
            'pageTitle' => 'Engagement social — ADETIS Engineering',
            'pageDescription' => "L'engagement social d'ADETIS pour la formation et la réinsertion professionnelle de la jeunesse.",
            'activeNav' => 'careers',
        ]);
    }
}
