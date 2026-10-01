<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;
use App\Core\Request;
use App\Core\Seo;
use App\Core\Validator;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /** Libellés français : valeurs enregistrées en base, quelle que soit la langue du visiteur. */
    private const SUBJECTS = [
        'etudes' => "Études CAO / DAO",
        'achats' => 'Achats de machines (Boostmarket)',
        'formation' => 'Formation & conférences',
        'partenariat' => 'Partenariat',
        'autre' => 'Autre demande',
    ];

    public function index(Request $request): void
    {
        $this->view('contact', $this->viewData([
            'old' => [],
            'errors' => [],
            'sent' => false,
        ]));
    }

    public function submit(Request $request): void
    {
        $data = $request->body;

        $validator = (new Validator())
            ->required($data, 'name', t('label.the_name'))
            ->required($data, 'email', t('label.email'))
            ->email($data, 'email', t('label.email'))
            ->required($data, 'subject', t('label.the_subject'))
            ->required($data, 'message', t('label.the_message'));

        $subjectKey = (string) ($data['subject'] ?? '');
        $errors = $validator->errors();

        if (!isset($errors['subject']) && !array_key_exists($subjectKey, self::SUBJECTS)) {
            $errors['subject'] = t('contact.error.subject');
        }

        if (count($errors) > 0) {
            $this->view('contact', $this->viewData([
                'old' => $data,
                'errors' => $errors,
                'sent' => false,
            ]));

            return;
        }

        ContactMessage::create([
            'name' => trim((string) $data['name']),
            'email' => trim((string) $data['email']),
            'phone' => trim((string) ($data['phone'] ?? '')) ?: null,
            'subject' => self::SUBJECTS[$subjectKey],
            'message' => trim((string) $data['message']),
        ]);

        $this->view('contact', $this->viewData([
            'old' => [],
            'errors' => [],
            'sent' => true,
        ]));
    }

    /** @param array<string, mixed> $extra @return array<string, mixed> */
    private function viewData(array $extra): array
    {
        return array_merge([
            'pageTitle' => t('contact.meta.title'),
            'pageDescription' => t('contact.meta.description'),
            'translated' => true,
            'activeNav' => 'contact',
            'subjects' => Lang::choices('contact.subject', self::SUBJECTS),
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('nav.contact')],
                ]),
            ],
        ], $extra);
    }
}
