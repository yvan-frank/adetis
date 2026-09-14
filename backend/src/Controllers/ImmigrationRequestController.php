<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Validator;
use App\Models\ImmigrationRequest;

class ImmigrationRequestController extends Controller
{
    private const CURRENT_LEVELS = [
        'bac' => 'Baccalauréat',
        'bac2' => 'Bac+2',
        'licence' => 'Licence / Bac+3',
        'master' => 'Master / Bac+4-5',
        'doctorat' => 'Doctorat',
        'autre' => 'Autre',
    ];

    private const TARGET_LEVELS = [
        'licence' => 'Licence',
        'master' => 'Master',
        'doctorat' => 'Doctorat',
        'ecole-ingenieur' => "École d'ingénieur",
        'ecole-commerce' => 'École de commerce',
        'but' => 'BUT (bachelor universitaire de technologie)',
        'autre' => 'Autre',
    ];

    private const INTAKES = [
        'septembre' => 'Rentrée de septembre',
        'janvier' => 'Rentrée de janvier',
        'indetermine' => 'Pas encore déterminée',
    ];

    private const STAGES = [
        'orientation' => "Orientation : je n'ai pas encore choisi ma formation",
        'dossier-campus-france' => 'Constitution du dossier Campus France',
        'preparation-entretiens' => "Préparation à l'entretien Campus France",
        'visa-etudiant' => 'Admis(e) — besoin d\'aide pour le visa étudiant',
        'installation-en-france' => 'Visa obtenu — installation en France',
        'suivi-post-admission' => 'Déjà en France — suivi post-admission',
        'autre' => 'Je ne sais pas encore',
    ];

    public function index(Request $request): void
    {
        $stage = (string) $request->input('etape', '');

        $this->view('immigration-request', $this->viewData([
            'old' => array_key_exists($stage, self::STAGES) ? ['stage' => $stage] : [],
            'errors' => [],
            'sent' => false,
        ]));
    }

    public function submit(Request $request): void
    {
        $data = $request->body;

        $validator = (new Validator())
            ->required($data, 'name', 'Le nom')
            ->required($data, 'email', 'Email')
            ->email($data, 'email', 'Email')
            ->required($data, 'phone', 'Le téléphone')
            ->required($data, 'country', 'Le pays de résidence')
            ->required($data, 'current_level', 'Le niveau actuel')
            ->required($data, 'current_field', 'La filière suivie')
            ->required($data, 'target_level', 'Le niveau visé')
            ->required($data, 'target_field', 'Le domaine souhaité')
            ->required($data, 'intake', 'La rentrée visée')
            ->required($data, 'stage', 'Votre étape actuelle')
            ->required($data, 'message', 'Le message');

        $errors = $validator->errors();

        $this->validateChoice($data, 'current_level', self::CURRENT_LEVELS, 'Le niveau actuel sélectionné est invalide.', $errors);
        $this->validateChoice($data, 'target_level', self::TARGET_LEVELS, 'Le niveau visé sélectionné est invalide.', $errors);
        $this->validateChoice($data, 'intake', self::INTAKES, 'La rentrée sélectionnée est invalide.', $errors);
        $this->validateChoice($data, 'stage', self::STAGES, "L'étape sélectionnée est invalide.", $errors);

        if (empty($data['consent'])) {
            $errors['consent'] = 'Merci de donner votre accord pour le traitement de vos données.';
        }

        if (count($errors) > 0) {
            $this->view('immigration-request', $this->viewData([
                'old' => $data,
                'errors' => $errors,
                'sent' => false,
            ]));

            return;
        }

        ImmigrationRequest::create([
            'name' => trim((string) $data['name']),
            'email' => trim((string) $data['email']),
            'phone' => trim((string) $data['phone']),
            'country' => trim((string) $data['country']),
            'current_level' => self::CURRENT_LEVELS[$data['current_level']],
            'current_field' => trim((string) $data['current_field']),
            'target_level' => self::TARGET_LEVELS[$data['target_level']],
            'target_field' => trim((string) $data['target_field']),
            'intake' => self::INTAKES[$data['intake']],
            'language_level' => trim((string) ($data['language_level'] ?? '')) ?: null,
            'stage' => self::STAGES[$data['stage']],
            'message' => trim((string) $data['message']),
        ]);

        $this->view('immigration-request', $this->viewData([
            'old' => [],
            'errors' => [],
            'sent' => true,
        ]));
    }

    /** @param array<string, mixed> $data @param array<string, string> $choices @param array<string, string> $errors */
    private function validateChoice(array $data, string $field, array $choices, string $message, array &$errors): void
    {
        if (isset($errors[$field])) {
            return;
        }

        $value = (string) ($data[$field] ?? '');

        if (!array_key_exists($value, $choices)) {
            $errors[$field] = $message;
        }
    }

    /** @param array<string, mixed> $extra @return array<string, mixed> */
    private function viewData(array $extra): array
    {
        return array_merge([
            'pageTitle' => 'Candidater — Immigration & Études en France — ADETIS Engineering',
            'pageDescription' => "Formulaire de candidature pour un accompagnement Campus France : orientation, dossier, entretien, visa étudiant et installation en France.",
            'activeNav' => 'services',
            'currentLevels' => self::CURRENT_LEVELS,
            'targetLevels' => self::TARGET_LEVELS,
            'intakes' => self::INTAKES,
            'stages' => self::STAGES,
        ], $extra);
    }
}
