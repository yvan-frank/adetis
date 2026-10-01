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
            'pageTitle' => t('about.meta.title'),
            'pageDescription' => t('about.meta.description'),
            'translated' => true,
            'activeNav' => 'about',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('nav.about')],
                ]),
            ],
        ]);
    }

    public function services(Request $request): void
    {
        $this->view('services', [
            'pageTitle' => t('services.meta.title'),
            'pageDescription' => t('services.meta.description'),
            'translated' => true,
            'activeNav' => 'services',
            'poles' => array_values(PoleController::all()),
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('nav.services')],
                ]),
            ],
        ]);
    }

    public function partners(Request $request): void
    {
        $this->view('partners', [
            'pageTitle' => t('partners.meta.title'),
            'pageDescription' => t('partners.meta.description'),
            'translated' => true,
            'activeNav' => 'partners',
            'ogImage' => '/assets/img/partnership-handshake.jpg',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('partners.breadcrumb')],
                ]),
            ],
        ]);
    }

    public function careers(Request $request): void
    {
        $this->view('careers', [
            'pageTitle' => t('careers.meta.title'),
            'pageDescription' => t('careers.meta.description'),
            'translated' => true,
            'activeNav' => 'careers',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('nav.careers')],
                ]),
            ],
        ]);
    }
}
