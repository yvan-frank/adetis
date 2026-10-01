<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Lang;
use App\Core\Request;
use App\Core\Seo;

class PoleController extends Controller
{
    public function show(Request $request): void
    {
        $poles = self::all();
        $slug = $request->params['slug'] ?? '';

        if (!isset($poles[$slug])) {
            http_response_code(404);
            $this->view('errors/404');
            return;
        }

        $pole = $poles[$slug];
        $others = array_filter($poles, fn (array $p) => $p['slug'] !== $slug);

        $this->view('pole-detail', [
            'pageTitle' => ($pole['seoTitle'] ?? $pole['title']) . ' — ADETIS Engineering',
            'translated' => true,
            'pageDescription' => $pole['metaDescription'],
            'activeNav' => 'services',
            'pole' => $pole,
            'others' => array_values($others),
            'ogImage' => $pole['image'],
            'jsonLd' => [
                Seo::breadcrumbJsonLd([
                    ['name' => t('nav.home'), 'path' => '/'],
                    ['name' => t('nav.services'), 'path' => '/poles-expertise'],
                    ['name' => $pole['shortTitle']],
                ]),
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'Service',
                    'name' => $pole['title'],
                    'description' => $pole['metaDescription'],
                    'url' => Seo::absoluteUrl(lurl('/poles-expertise/' . $pole['slug'])),
                    'provider' => [
                        '@type' => 'Organization',
                        'name' => 'ADETIS Engineering',
                        'url' => Seo::absoluteUrl(lurl('/')),
                    ],
                    'areaServed' => [t('seo.area_cameroon'), 'CEMAC', t('seo.area_france')],
                ],
            ],
        ]);
    }

    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        static $poles = null;

        if ($poles !== null) {
            return $poles;
        }

        $list = [
            [
                'slug' => 'bureau-etudes-methodes',
                'number' => 1,
                'image' => '/assets/img/poles/bureau-etudes-methodes.jpg',
                'eyebrow' => "Pôle 1 — Ingénierie",
                'title' => "Bureau d'Études & Méthodes (CAO / DAO)",
                'shortTitle' => "Bureau d'Études & Méthodes",
                'lead' => "Nous transformons vos idées en plans, modèles 3D et dossiers d'exécution exploitables sur le terrain : mécanique, automatisation, énergétique, électricité, tuyauterie, génie civil et chaudronnerie.",
                'metaDescription' => "Conception et modélisation CAO/DAO 2D/3D : mécanique, automatisation, énergétique, tuyauterie, génie civil et chaudronnerie, sous AutoCAD, SolidWorks, CATIA.",
                'stats' => [
                    ['value' => '8+', 'label' => 'Logiciels CAO/DAO maîtrisés'],
                    ['value' => '2D/3D', 'label' => 'Modélisation complète'],
                    ['value' => '7', 'label' => "Domaines d'ingénierie couverts"],
                ],
                'features' => [
                    ['icon' => '📐', 'title' => 'Conception mécanique', 'desc' => "Modélisation de pièces, assemblages et systèmes mécaniques prêts pour la fabrication."],
                    ['icon' => '⚙️', 'title' => 'Automatisation', 'desc' => "Schémas et dossiers techniques pour vos lignes et process automatisés."],
                    ['icon' => '🔌', 'title' => 'Électricité & énergétique', 'desc' => "Études de réseaux, schémas unifilaires et dimensionnement énergétique."],
                    ['icon' => '🧱', 'title' => 'Génie civil & BTP', 'desc' => "Plans d'exécution, coffrage et ferraillage pour vos ouvrages."],
                    ['icon' => '🛠️', 'title' => 'Tuyauterie & hydro-thermique', 'desc' => "Isométriques, réseaux fluides et bilans thermiques."],
                    ['icon' => '🔥', 'title' => 'Chaudronnerie', 'desc' => "Développés de tôle, cuves et structures chaudronnées."],
                ],
                'process' => [
                    ['title' => 'Cadrage', 'desc' => "Analyse de votre besoin, contraintes techniques et normatives."],
                    ['title' => 'Modélisation', 'desc' => "Conception 2D/3D sous le logiciel le plus adapté à votre projet."],
                    ['title' => 'Vérification', 'desc' => "Calculs, simulations et contrôle qualité des livrables."],
                    ['title' => 'Livraison', 'desc' => "Dossier d'exécution complet, prêt pour la production ou le chantier."],
                ],
                'tags' => ['AutoCAD', 'SolidWorks', 'CATIA', 'SketchUp', 'Mathcad', 'Matlab', 'Allplan', 'ANSYS'],
                'tagsLabel' => 'Logiciels maîtrisés',
            ],
            [
                'slug' => 'recherche-appliquee',
                'number' => 2,
                'image' => '/assets/img/poles/recherche-appliquee.jpg',
                'eyebrow' => "Pôle 2 — Innovation",
                'title' => "Recherche Appliquée & Centre de Production Mécanique",
                'shortTitle' => "Recherche Appliquée",
                'seoTitle' => "Recherche Appliquée & Production Mécanique",
                'lead' => "Un laboratoire et un centre de fabrication de pièces mécaniques dédiés à l'innovation industrielle, au service de la modernisation des industries locales et de la valorisation des ressources naturelles.",
                'metaDescription' => "Laboratoire et centre de production mécanique dédiés à la recherche, l'innovation et la modernisation de l'industrie locale.",
                'stats' => [
                    ['value' => 'R&D', 'label' => 'Laboratoire dédié'],
                    ['value' => '100%', 'label' => 'Production locale'],
                    ['value' => 'CEMAC', 'label' => "Zone d'impact prioritaire"],
                ],
                'features' => [
                    ['icon' => '🔬', 'title' => "Recherche & innovation", 'desc' => "Développement de solutions techniques adaptées aux réalités industrielles locales."],
                    ['icon' => '🏭', 'title' => 'Production mécanique', 'desc' => "Fabrication de pièces mécaniques sur mesure pour l'industrie."],
                    ['icon' => '⛏️', 'title' => 'Valorisation des ressources', 'desc' => "Appui technique aux acteurs de l'extraction et de la transformation."],
                    ['icon' => '🤝', 'title' => 'Partenariats industriels', 'desc' => "Collaboration avec les industries locales pour leur modernisation."],
                ],
                'process' => [
                    ['title' => 'Diagnostic', 'desc' => "Étude du besoin industriel et des contraintes de production."],
                    ['title' => 'Prototypage', 'desc' => "Conception et essais en laboratoire avant industrialisation."],
                    ['title' => 'Production', 'desc' => "Fabrication des pièces mécaniques au centre de production."],
                    ['title' => 'Accompagnement', 'desc' => "Suivi technique et amélioration continue sur le terrain."],
                ],
                'tags' => [],
                'tagsLabel' => '',
            ],
            [
                'slug' => 'boostmarket',
                'number' => 3,
                'image' => '/assets/img/poles/boostmarket.jpg',
                'eyebrow' => "Pôle 3 — Équipements",
                'title' => "Boostmarket — Achat, Vente & Location d'Équipements",
                'shortTitle' => "Boostmarket",
                'seoTitle' => "Boostmarket — Équipements Industriels",
                'lead' => "Notre plateforme d'approvisionnement en matériels et machines industrielles neufs et de seconde main, avec des services de location, de revente, d'achat de pièces de maintenance et de transfert de marchandises depuis Amazon pour PME, grandes entreprises, BTP, secteur médical et universitaire.",
                'metaDescription' => "Boostmarket : achat, vente et location de matériels et machines industrielles neufs et d'occasion, pour PME, BTP, secteur médical et universitaire.",
                'stats' => [
                    ['value' => 'Neuf', 'label' => '& seconde main'],
                    ['value' => '4', 'label' => 'Secteurs desservis'],
                    ['value' => '360°', 'label' => "Achat, vente, location"],
                ],
                'features' => [
                    ['icon' => '🛒', 'title' => "Achat d'équipements", 'desc' => "Sourcing de machines industrielles neuves et d'occasion, contrôlées."],
                    ['icon' => '💰', 'title' => 'Vente & revente', 'desc' => "Valorisation de vos équipements auprès de notre réseau d'acheteurs."],
                    ['icon' => '📦', 'title' => 'Location de matériel', 'desc' => "Solutions locatives flexibles pour vos chantiers et productions."],
                    ['icon' => '🔧', 'title' => 'Pièces mécaniques & automobiles', 'desc' => "Achat de pièces mécaniques et automobiles pour assurer la maintenance de vos équipements et véhicules."],
                    ['icon' => '🚚', 'title' => 'Transfert depuis Amazon', 'desc' => "Prise en charge du transfert de marchandises achetées sur la plateforme Amazon jusqu'à destination."],
                    ['icon' => '🏥', 'title' => 'Secteurs spécialisés', 'desc' => "Équipements dédiés au BTP, au médical et à l'universitaire."],
                ],
                'process' => [
                    ['title' => 'Besoin', 'desc' => "Nous qualifions votre besoin en matériel et votre budget."],
                    ['title' => 'Sourcing', 'desc' => "Sélection d'équipements neufs ou d'occasion contrôlés."],
                    ['title' => 'Transaction', 'desc' => "Achat, vente ou mise en location selon votre besoin."],
                    ['title' => 'Suivi', 'desc' => "Livraison, installation et service après-vente."],
                ],
                'tags' => ['PME & grandes entreprises', 'BTP', 'Secteur médical', 'Secteur universitaire'],
                'tagsLabel' => 'Clients cibles',
            ],
            [
                'slug' => 'formation-conferences',
                'number' => 4,
                'image' => '/assets/img/poles/formation-conferences.jpg',
                'eyebrow' => "Pôle 4 — Compétences",
                'title' => "Formation, Recyclage & Conférences",
                'shortTitle' => "Formation & Conférences",
                'lead' => "Des modules de formation continue et spécialisée — risques chimiques, ATEX, sciences & technologies — dispensés en groupes réduits de 15 participants maximum, avec des partenariats universitaires.",
                'metaDescription' => "Formations continues et spécialisées (risques chimiques, ATEX, sciences & technologies) en petits groupes, avec partenariats universitaires.",
                'stats' => [
                    ['value' => '15', 'label' => 'Participants max par session'],
                    ['value' => '100%', 'label' => 'Suivi personnalisé'],
                    ['value' => 'Univ.', 'label' => 'Partenariats académiques'],
                ],
                'features' => [
                    ['icon' => '☣️', 'title' => 'Risques chimiques', 'desc' => "Formation à la prévention et à la gestion des risques chimiques industriels."],
                    ['icon' => '🧯', 'title' => 'ATEX', 'desc' => "Sensibilisation et certification aux atmosphères explosives."],
                    ['icon' => '🔭', 'title' => 'Sciences & technologies', 'desc' => "Modules spécialisés pour actualiser les compétences techniques."],
                    ['icon' => '🎓', 'title' => 'Conférences & recyclage', 'desc' => "Sessions de mise à niveau et conférences thématiques."],
                ],
                'process' => [
                    ['title' => 'Diagnostic', 'desc' => "Identification des besoins de montée en compétences."],
                    ['title' => 'Programme', 'desc' => "Construction d'un module adapté à votre équipe."],
                    ['title' => 'Formation', 'desc' => "Sessions en petits groupes, format présentiel personnalisé."],
                    ['title' => 'Évaluation', 'desc' => "Bilan de compétences et attestation de participation."],
                ],
                'tags' => [],
                'tagsLabel' => '',
            ],
            [
                'slug' => 'immigration-etudes-france',
                'number' => 5,
                'image' => '/assets/img/poles/immigration-etudes-france.jpg',
                'eyebrow' => "Pôle 5 — Mobilité internationale",
                'title' => "Immigration & Études en France (Campus France)",
                'shortTitle' => "Immigration & Études en France",
                'seoTitle' => "Immigration & Études en France",
                'lead' => "Un accompagnement complet pour réussir votre mobilité étudiante vers la France : procédure Campus France, choix d'orientation, dossier de candidature, entretien et visa étudiant.",
                'metaDescription' => "Accompagnement complet de la procédure Campus France : orientation, dossier Études en France, préparation aux entretiens et visa étudiant.",
                'stats' => [
                    ['value' => '1', 'label' => "Interlocuteur dédié de A à Z"],
                    ['value' => 'Visa', 'label' => 'Étudiant inclus'],
                    ['value' => 'FR 🇫🇷', 'label' => "Présence sur place à Paris"],
                ],
                'features' => [
                    ['icon' => '🧭', 'title' => "Orientation", 'desc' => "Choix de la formation et de l'établissement selon votre profil et vos objectifs.", 'slug' => 'orientation'],
                    ['icon' => '📋', 'title' => 'Dossier Campus France', 'desc' => "Montage et suivi complet du dossier Études en France.", 'slug' => 'dossier-campus-france'],
                    ['icon' => '🗣️', 'title' => 'Préparation aux entretiens', 'desc' => "Coaching pour réussir l'entretien de motivation.", 'slug' => 'preparation-entretiens'],
                    ['icon' => '🛂', 'title' => 'Visa étudiant', 'desc' => "Constitution du dossier de demande de visa long séjour étudiant.", 'slug' => 'visa-etudiant'],
                    ['icon' => '🏠', 'title' => 'Installation en France', 'desc' => "Appui aux démarches administratives d'arrivée et d'installation.", 'slug' => 'installation-en-france'],
                    ['icon' => '📞', 'title' => 'Suivi post-admission', 'desc' => "Accompagnement continu jusqu'à la réussite du diplôme et au-delà.", 'slug' => 'suivi-post-admission'],
                ],
                'process' => [
                    ['title' => 'Bilan & orientation', 'desc' => "Analyse de votre profil académique et de votre projet d'études."],
                    ['title' => 'Constitution du dossier', 'desc' => "Montage du dossier Campus France et des candidatures."],
                    ['title' => 'Entretien & visa', 'desc' => "Préparation à l'entretien puis constitution du dossier de visa."],
                    ['title' => 'Départ & installation', 'desc' => "Accompagnement jusqu'à votre arrivée et votre installation en France."],
                ],
                'tags' => ['Procédure Études en France', "Choix d'établissement", 'Constitution du dossier', 'Préparation aux entretiens', 'Demande de visa étudiant', 'Suivi post-admission'],
                'tagsLabel' => 'Notre accompagnement',
            ],
        ];

        $poles = [];
        foreach ($list as $pole) {
            $poles[$pole['slug']] = $pole;
        }

        // Textes de la langue courante (lang/<code>/content/poles.php), par slug.
        $poles = Lang::overlay($poles, 'poles');

        return $poles;
    }
}
