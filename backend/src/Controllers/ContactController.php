<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Validator;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    private const SUBJECTS = [
        'etudes' => "Études CAO / DAO",
        'achats' => 'Achats de machines (Boostmarket)',
        'formation' => 'Formation & conférences',
        'partenariat' => 'Partenariat',
        'autre' => 'Autre demande',
    ];

    public function index(Request $request): void
    {
        $this->view('contact', [
            'pageTitle' => 'Contact — ADETIS Engineering',
            'pageDescription' => 'Contactez ADETIS Engineering : siège de Douala (Cameroun) et filiale de Paris (France).',
            'activeNav' => 'contact',
            'subjects' => self::SUBJECTS,
            'old' => [],
            'errors' => [],
            'sent' => false,
        ]);
    }

    public function submit(Request $request): void
    {
        $data = $request->body;

        $validator = (new Validator())
            ->required($data, 'name', 'Le nom')
            ->required($data, 'email', 'Email')
            ->email($data, 'email', 'Email')
            ->required($data, 'subject', 'Le sujet')
            ->required($data, 'message', 'Le message');

        $subjectKey = (string) ($data['subject'] ?? '');
        $errors = $validator->errors();

        if (!isset($errors['subject']) && !array_key_exists($subjectKey, self::SUBJECTS)) {
            $errors['subject'] = 'Le sujet sélectionné est invalide.';
        }

        if (count($errors) > 0) {
            $this->view('contact', [
                'pageTitle' => 'Contact — ADETIS Engineering',
                'pageDescription' => 'Contactez ADETIS Engineering : siège de Douala (Cameroun) et filiale de Paris (France).',
                'activeNav' => 'contact',
                'subjects' => self::SUBJECTS,
                'old' => $data,
                'errors' => $errors,
                'sent' => false,
            ]);

            return;
        }

        ContactMessage::create([
            'name' => trim((string) $data['name']),
            'email' => trim((string) $data['email']),
            'phone' => trim((string) ($data['phone'] ?? '')) ?: null,
            'subject' => self::SUBJECTS[$subjectKey],
            'message' => trim((string) $data['message']),
        ]);

        $this->view('contact', [
            'pageTitle' => 'Contact — ADETIS Engineering',
            'pageDescription' => 'Contactez ADETIS Engineering : siège de Douala (Cameroun) et filiale de Paris (France).',
            'activeNav' => 'contact',
            'subjects' => self::SUBJECTS,
            'old' => [],
            'errors' => [],
            'sent' => true,
        ]);
    }
}
