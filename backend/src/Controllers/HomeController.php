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
            'pageTitle' => t('home.meta.title'),
            'pageDescription' => t('home.meta.description'),
            'translated' => true,
            'activeNav' => 'home',
            'ogImage' => '/assets/img/logo-adetis.png',
            'jsonLd' => [
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => 'ADETIS Engineering',
                    'url' => Seo::absoluteUrl(lurl('/')),
                ],
            ],
        ]);
    }
}
