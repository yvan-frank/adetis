<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;
use App\Core\Request;
use App\Core\Seo;
use App\Core\Validator;
use App\Models\ImmigrationRequest;

class ImmigrationRequestController extends Controller
{
    // Libellés français : valeurs enregistrées en base, quelle que soit la langue du visiteur.
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
            ->required($data, 'name', t('label.the_name'))
            ->required($data, 'email', t('label.email'))
            ->email($data, 'email', t('label.email'))
            ->required($data, 'phone', t('label.the_phone'))
            ->required($data, 'country', t('label.the_country'))
            ->required($data, 'current_level', t('label.the_current_level'))
            ->required($data, 'current_field', t('label.the_current_field'))
            ->required($data, 'target_level', t('label.the_target_level'))
            ->required($data, 'target_field', t('label.the_target_field'))
            ->required($data, 'intake', t('label.the_intake'))
            ->required($data, 'stage', t('label.the_stage'))
            ->required($data, 'message', t('label.the_message'));

        $errors = $validator->errors();

        $this->validateChoice($data, 'current_level', self::CURRENT_LEVELS, t('immigration.error.current_level'), $errors);
        $this->validateChoice($data, 'target_level', self::TARGET_LEVELS, t('immigration.error.target_level'), $errors);
        $this->validateChoice($data, 'intake', self::INTAKES, t('immigration.error.intake'), $errors);
        $this->validateChoice($data, 'stage', self::STAGES, t('immigration.error.stage'), $errors);

        if (empty($data['consent'])) {
            $errors['consent'] = t('immigration.error.consent');
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
            'pageTitle' => t('immigration.meta.title'),
            'pageDescription' => t('immigration.meta.description'),
            'translated' => true,
            'activeNav' => 'services',
            'currentLevels' => Lang::choices('immigration.current_level', self::CURRENT_LEVELS),
            'targetLevels' => Lang::choices('immigration.target_level', self::TARGET_LEVELS),
            'intakes' => Lang::choices('immigration.intake', self::INTAKES),
            'stages' => Lang::choices('immigration.stage', self::STAGES),
            'ogImage' => '/assets/img/poles/immigration-etudes-france.jpg',
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('nav.services'), 'path' => '/poles-expertise'],
                    ['name' => t('pole.immigration_name'), 'path' => '/poles-expertise/immigration-etudes-france'],
                    ['name' => t('immigration.breadcrumb')],
                ]),
            ],
        ], $extra);
    }
}
