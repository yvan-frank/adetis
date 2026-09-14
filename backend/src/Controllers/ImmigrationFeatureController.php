<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class ImmigrationFeatureController extends Controller
{
    public function show(Request $request): void
    {
        $features = self::all();
        $slug = $request->params['feature'] ?? '';

        if (!isset($features[$slug])) {
            http_response_code(404);
            $this->view('errors/404');
            return;
        }

        $feature = $features[$slug];
        $others = array_filter($features, fn (array $f) => $f['slug'] !== $slug);

        $this->view('immigration-feature-detail', [
            'pageTitle' => $feature['title'] . ' — ADETIS Engineering',
            'pageDescription' => $feature['metaDescription'],
            'activeNav' => 'services',
            'feature' => $feature,
            'others' => array_values($others),
        ]);
    }

    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        static $features = null;

        if ($features !== null) {
            return $features;
        }

        $list = [
            [
                'slug' => 'orientation',
                'icon' => '🧭',
                'eyebrow' => 'Immigration & Études en France',
                'title' => "Orientation : choisir la bonne formation et le bon établissement",
                'lead' => "Avant toute démarche administrative, la réussite d'un projet d'études en France se joue sur un bon choix d'orientation : la bonne filière, le bon niveau, le bon établissement et la bonne ville, en cohérence avec votre profil et votre projet professionnel.",
                'metaDescription' => "Orientation vers les études en France : comprendre le système LMD, choisir ses formations sur Études en France et éviter les pièges des établissements non reconnus.",
                'stats' => [
                    ['value' => '7', 'label' => 'Vœux de formation possibles'],
                    ['value' => 'LMD', 'label' => 'Licence · Master · Doctorat'],
                    ['value' => '2', 'label' => 'Rentrées : septembre & janvier'],
                ],
                'sections' => [
                    [
                        'heading' => "Comprendre le système d'enseignement supérieur français",
                        'paragraphs' => [
                            "La France fonctionne sur le système LMD (Licence – Master – Doctorat), harmonisé au niveau européen : Licence en 3 ans (Bac+3), Master en 2 ans (Bac+5) et Doctorat en 3 ans (Bac+8). À côté des universités, il existe des écoles d'ingénieurs, écoles de commerce, IUT/BUT (bachelor universitaire de technologie en 3 ans) et écoles spécialisées, chacune avec ses propres modalités d'admission.",
                            "Le bon choix ne dépend pas uniquement de la réputation d'un établissement : il doit tenir compte de votre niveau académique réel, de votre niveau de français ou d'anglais selon la formation, de votre budget et de vos perspectives professionnelles au retour ou en France.",
                        ],
                    ],
                    [
                        'heading' => "Comment nous vous accompagnons",
                        'paragraphs' => [
                            "Nous réalisons un bilan complet de votre parcours académique et de votre projet professionnel, puis nous vous aidons à sélectionner jusqu'à 7 vœux de formation sur la plateforme Études en France, répartis intelligemment entre établissements sélectifs et établissements plus accessibles pour sécuriser votre admission.",
                        ],
                        'items' => [
                            "Analyse de votre dossier académique et identification des filières adaptées",
                            "Sélection d'établissements reconnus par l'État français (essentiel pour le visa)",
                            "Arbitrage entre grandes villes universitaires et villes à coût de la vie plus accessible",
                            "Vérification de l'adéquation entre prérequis de la formation et votre profil",
                            "Construction d'un projet d'études cohérent, argument central de tout le dossier",
                        ],
                    ],
                    [
                        'heading' => 'Points de vigilance',
                        'paragraphs' => [
                            "Un établissement non accrédité ou non reconnu par le ministère de l'Enseignement supérieur français peut entraîner un refus de visa, même avec un dossier académique solide. Nous vérifions systématiquement la reconnaissance officielle de chaque établissement avant de le proposer.",
                        ],
                    ],
                ],
                'faq' => [
                    ['q' => 'Puis-je modifier mes vœux après les avoir validés sur Études en France ?', 'a' => "Une fois le paiement effectué et le dossier envoyé aux établissements, les vœux ne peuvent plus être modifiés pour la campagne en cours. C'est pourquoi le travail d'orientation en amont est déterminant."],
                    ['q' => "Dois-je déjà avoir un contact avec l'université avant de candidater ?", 'a' => "Non, ce n'est pas obligatoire. En revanche, une lettre de motivation précise et documentée sur la formation visée renforce fortement votre dossier."],
                    ['q' => 'Puis-je viser un niveau différent de mon diplôme actuel ?', 'a' => "Oui, sous réserve d'équivalence. Nous évaluons avec vous les correspondances entre votre diplôme d'origine et le niveau LMD français avant de construire votre stratégie de candidature."],
                ],
            ],
            [
                'slug' => 'dossier-campus-france',
                'icon' => '📋',
                'eyebrow' => 'Immigration & Études en France',
                'title' => "Dossier Campus France : montage et suivi de la procédure Études en France",
                'lead' => "La procédure « Études en France » est obligatoire pour les candidats de plus de 70 pays et conditionne l'obtention du visa étudiant. Un dossier complet, cohérent et déposé dans les délais est la clé d'un avis favorable.",
                'metaDescription' => "Montage du dossier Campus France Études en France : documents requis, calendrier, frais et suivi jusqu'à l'avis final de l'établissement.",
                'stats' => [
                    ['value' => '70+', 'label' => 'Pays concernés par la procédure'],
                    ['value' => '8', 'label' => 'Mois de procédure en moyenne'],
                    ['value' => '7', 'label' => 'Candidatures possibles en parallèle'],
                ],
                'sections' => [
                    [
                        'heading' => 'Les pièces à réunir',
                        'paragraphs' => [
                            "Le dossier Études en France repose sur des pièces précises, souvent à faire traduire par un traducteur assermenté. Un document manquant ou une traduction non conforme retarde systématiquement l'instruction du dossier.",
                        ],
                        'items' => [
                            "Diplômes et relevés de notes des 3 dernières années, traduits",
                            "CV actualisé et lettre de motivation rédigée pour chaque formation visée",
                            "Copie du passeport en cours de validité et acte de naissance",
                            "Photos d'identité aux normes et justificatifs complémentaires selon le pays",
                            "Le cas échéant, certificats de langue (français ou anglais) exigés par la formation",
                        ],
                    ],
                    [
                        'heading' => 'Le calendrier de la procédure',
                        'paragraphs' => [
                            "La procédure s'étend sur environ huit mois : ouverture du dossier en ligne à l'automne, dépôt des candidatures et paiement des frais (de l'ordre de 50 à 99 € selon le pays, auxquels s'ajoutent environ 50 € par candidature universitaire), instruction par les établissements au printemps, puis réponses définitives avant l'été.",
                        ],
                    ],
                    [
                        'heading' => "Notre suivi jusqu'à l'avis final",
                        'paragraphs' => [
                            "Nous ne nous contentons pas de monter le dossier : nous suivons son avancement à chaque étape, relançons si nécessaire, et vous alertons dès qu'une action de votre part est requise (complément de pièce, confirmation de vœu, paiement).",
                        ],
                        'items' => [
                            "Vérification de la conformité de chaque pièce avant envoi",
                            "Rédaction et relecture des lettres de motivation par formation",
                            "Suivi du statut du dossier sur la plateforme (en attente, en cours, avis rendu)",
                            "Conseil en cas d'avis défavorable pour rebondir sur une autre candidature",
                        ],
                    ],
                ],
                'faq' => [
                    ['q' => "Que faire en cas d'avis défavorable d'un établissement ?", 'a' => "Un avis défavorable ne bloque pas tout le dossier : vos autres vœux restent instruits. Nous analysons les motifs du refus pour renforcer vos candidatures suivantes et, si besoin, préparer une nouvelle campagne."],
                    ['q' => 'La procédure Campus France est-elle payante ?', 'a' => "Oui. Elle inclut des frais de dossier (50 à 99 € selon le pays) et des frais de candidature par établissement (environ 50 € chacun), à prévoir en plus des frais de scolarité."],
                    ['q' => 'Combien de temps pour recevoir une réponse ?', 'a' => "Les délais varient selon les établissements, mais la procédure se termine généralement en fin de printemps, avec confirmation du vœu retenu avant l'été."],
                ],
            ],
            [
                'slug' => 'preparation-entretiens',
                'icon' => '🗣️',
                'eyebrow' => 'Immigration & Études en France',
                'title' => "Préparation aux entretiens Campus France",
                'lead' => "Dans de nombreux pays, un entretien avec un conseiller Campus France conditionne la validation du dossier. C'est le moment où votre motivation, la cohérence de votre projet et votre niveau de français ou d'anglais sont évalués en direct.",
                'metaDescription' => "Préparation à l'entretien Campus France : objectifs, questions fréquentes, conseils pratiques et coaching personnalisé avec ADETIS Engineering.",
                'stats' => [
                    ['value' => '15-20', 'label' => "Minutes en moyenne"],
                    ['value' => '2-3', 'label' => "Séances de coaching conseillées"],
                    ['value' => '0', 'label' => "Réponse apprise par cœur"],
                ],
                'sections' => [
                    [
                        'heading' => "L'objectif réel de l'entretien",
                        'paragraphs' => [
                            "Le conseiller ne cherche pas à vous piéger : il vérifie l'authenticité de votre dossier, la cohérence entre votre parcours et les formations demandées, la réalité de votre projet d'études et, souvent, votre projet professionnel au retour dans votre pays d'origine.",
                        ],
                    ],
                    [
                        'heading' => 'Les thèmes récurrents',
                        'paragraphs' => [
                            "Certaines questions reviennent quasi systématiquement, sous des formulations différentes.",
                        ],
                        'items' => [
                            "Pourquoi ce pays, cette ville et cet établissement en particulier ?",
                            "Pourquoi cette formation, et comment s'inscrit-elle dans votre parcours ?",
                            "Comment allez-vous financer vos études et votre séjour ?",
                            "Quel est votre projet professionnel une fois le diplôme obtenu ?",
                            "Quel est votre niveau dans la langue d'enseignement ?",
                        ],
                    ],
                    [
                        'heading' => 'Notre coaching',
                        'paragraphs' => [
                            "Nous organisons des simulations d'entretien dans des conditions proches du réel, avec correction immédiate sur le fond (cohérence du projet) et la forme (élocution, posture, gestion du stress). L'objectif n'est jamais de mémoriser des réponses, mais de construire un discours naturel et argumenté.",
                        ],
                        'items' => [
                            "Simulations d'entretien filmées avec débriefing",
                            "Travail sur l'argumentaire du choix de formation et d'établissement",
                            "Conseils de présentation et de posture le jour J",
                            "Préparation aux questions pièges sur le budget et le retour au pays",
                        ],
                    ],
                ],
                'faq' => [
                    ['q' => "L'entretien est-il obligatoire dans tous les pays ?", 'a' => "Non, il dépend des accords entre la France et votre pays de résidence. Nous vous indiquons dès le début de l'accompagnement si un entretien est requis dans votre cas."],
                    ['q' => "Que se passe-t-il si l'entretien se passe mal ?", 'a' => "Un entretien jugé insuffisant peut conduire à un avis défavorable sur le dossier. C'est pourquoi la préparation en amont avec un accompagnement dédié réduit fortement ce risque."],
                    ['q' => "Dois-je passer l'entretien en français ?", 'a' => "Cela dépend de la formation visée : une formation dispensée en français nécessite généralement un entretien en français, avec parfois un test de niveau en complément."],
                ],
            ],
            [
                'slug' => 'visa-etudiant',
                'icon' => '🛂',
                'eyebrow' => 'Immigration & Études en France',
                'title' => "Visa étudiant : constitution du dossier VLS-TS",
                'lead' => "Une fois l'admission obtenue, la demande de visa long séjour valant titre de séjour (VLS-TS) mention « étudiant » est l'étape qui autorise concrètement votre entrée et votre séjour en France pour plus de trois mois.",
                'metaDescription' => "Constitution du dossier de visa étudiant VLS-TS : pièces justificatives, ressources financières exigées, dépôt au consulat et délais.",
                'stats' => [
                    ['value' => 'VLS-TS', 'label' => "Visa long séjour valant titre de séjour"],
                    ['value' => '~615€', 'label' => "Ressources mensuelles de référence"],
                    ['value' => '3 mois', 'label' => "Délai de validation après arrivée"],
                ],
                'sections' => [
                    [
                        'heading' => 'Les pièces du dossier de visa',
                        'paragraphs' => [
                            "Le dossier de visa s'appuie sur l'avis favorable obtenu via Études en France, complété par des justificatifs financiers et administratifs propres à la demande de visa.",
                        ],
                        'items' => [
                            "Avis favorable Campus France et attestation de préinscription ou d'inscription",
                            "Passeport valide, photos d'identité et formulaire de demande de visa long séjour",
                            "Justificatifs de ressources suffisantes pour couvrir séjour et études",
                            "Justificatif de logement en France (attestation d'accueil ou réservation)",
                            "Justificatif d'assurance et, selon le pays, certificat médical",
                        ],
                    ],
                    [
                        'heading' => 'Dépôt et délais',
                        'paragraphs' => [
                            "La demande se dépose auprès du consulat de France ou d'un prestataire agréé (par exemple TLScontact ou VFS Global selon le pays), généralement avec un entretien de vérification des pièces. Les délais de traitement varient selon les périodes de l'année : plus la demande est déposée tôt après l'obtention de l'avis favorable, plus vous sécurisez votre date de rentrée.",
                        ],
                    ],
                    [
                        'heading' => 'Notre accompagnement',
                        'paragraphs' => [
                            "Nous préparons avec vous une checklist personnalisée selon votre pays de résidence, relisons l'ensemble du dossier avant dépôt et vous préparons à l'entretien au guichet consulaire pour limiter tout risque de rejet pour dossier incomplet.",
                        ],
                    ],
                ],
                'faq' => [
                    ['q' => "L'obtention du visa est-elle automatique après l'avis favorable Campus France ?", 'a' => "Non. L'avis favorable est indispensable mais ne garantit pas la délivrance du visa : les autorités consulaires vérifient également les ressources financières, le logement et la cohérence globale du dossier."],
                    ['q' => "Que faire en cas de refus de visa ?", 'a' => "Un recours est possible auprès de la commission compétente. Nous analysons les motifs du refus avec vous pour déterminer la meilleure stratégie : recours, nouvelle demande ou report de rentrée."],
                    ['q' => "Quelle somme dois-je justifier pour mes ressources ?", 'a' => "Le consulat se réfère généralement au montant de bourse mensuelle de référence Campus France (environ 615 € par mois), à adapter selon le coût de la vie de la ville d'accueil."],
                ],
            ],
            [
                'slug' => 'installation-en-france',
                'icon' => '🏠',
                'eyebrow' => 'Immigration & Études en France',
                'title' => "Installation en France : vos démarches administratives à l'arrivée",
                'lead' => "L'arrivée en France déclenche une série de démarches à effectuer dans des délais précis : validation du visa, contribution étudiante, sécurité sociale, logement et compte bancaire. Un calendrier mal maîtrisé peut mettre en péril votre séjour.",
                'metaDescription' => "Démarches d'installation en France pour étudiants étrangers : validation VLS-TS, CVEC, sécurité sociale, logement CAF/APL et ouverture de compte bancaire.",
                'stats' => [
                    ['value' => '150€', 'label' => 'Validation du VLS-TS sur l\'ANEF'],
                    ['value' => '~105€', 'label' => 'CVEC obligatoire avant inscription'],
                    ['value' => '3 mois', 'label' => 'Délai maximum pour valider le visa'],
                ],
                'sections' => [
                    [
                        'heading' => 'Les démarches prioritaires',
                        'paragraphs' => [
                            "Certaines démarches sont soumises à des délais stricts et doivent être anticipées dès la préparation du départ.",
                        ],
                        'items' => [
                            "Validation du VLS-TS sur le site de l'administration (ANEF) dans les 3 mois suivant l'entrée en France, moyennant une taxe d'environ 150 €",
                            "Paiement de la Contribution Vie Étudiante et de Campus (CVEC), environ 105 €, obligatoire avant toute inscription administrative à l'université",
                            "Inscription à la sécurité sociale étudiante pour obtenir un numéro puis une carte Vitale",
                            "Ouverture d'un compte bancaire français avec RIB, nécessaire pour percevoir d'éventuelles aides",
                            "Recherche de logement (résidence CROUS, résidence privée, colocation) et dépôt d'une demande d'aide au logement auprès de la CAF si éligible",
                        ],
                    ],
                    [
                        'heading' => 'Logement et aides CAF',
                        'paragraphs' => [
                            "La demande d'aide au logement peut être initiée en ligne dès la signature du bail, avec un dossier réunissant passeport, visa ou titre de séjour, acte de naissance, certificat de scolarité, contrat de location et RIB. Les conditions d'éligibilité pour les étudiants non européens évoluent régulièrement : nous vérifions avec vous les critères en vigueur au moment de votre installation.",
                        ],
                    ],
                    [
                        'heading' => 'Notre accompagnement à distance et sur place',
                        'paragraphs' => [
                            "Grâce à notre filiale basée à Paris, nous pouvons vous accompagner concrètement dans ces démarches dès votre arrivée : prise de rendez-vous, constitution des dossiers CAF et sécurité sociale, orientation vers des solutions de logement adaptées à votre budget.",
                        ],
                    ],
                ],
                'faq' => [
                    ['q' => "Que se passe-t-il si je ne valide pas mon visa dans les 3 mois ?", 'a' => "Passé ce délai, votre visa perd sa validité de titre de séjour : vous perdez le droit de travailler et l'accès à certaines prestations sociales, avec un risque de situation irrégulière."],
                    ['q' => "La CVEC est-elle remboursable si je change de formation ?", 'a' => "La CVEC est due une seule fois par année universitaire, quel que soit le nombre d'inscriptions dans la même année."],
                    ['q' => "Puis-je travailler dès mon arrivée ?", 'a' => "Le droit de travailler est ouvert dès la validation du VLS-TS ou l'obtention de la carte de séjour étudiant, dans la limite de 964 heures par an."],
                ],
            ],
            [
                'slug' => 'suivi-post-admission',
                'icon' => '📞',
                'eyebrow' => 'Immigration & Études en France',
                'title' => "Suivi post-admission : réussir son parcours jusqu'au diplôme et au-delà",
                'lead' => "Notre accompagnement ne s'arrête pas à la rentrée universitaire. Nous restons à vos côtés tout au long du séjour : renouvellement du titre de séjour, droit au travail étudiant, poursuite d'études et transition vers l'emploi après le diplôme.",
                'metaDescription' => "Suivi post-admission des étudiants en France : renouvellement du titre de séjour, droit au travail étudiant (964 heures) et transition vers l'emploi (APS, RECE).",
                'stats' => [
                    ['value' => '964h', 'label' => "Heures de travail autorisées par an"],
                    ['value' => '12 mois', 'label' => "Durée de l'autorisation de recherche d'emploi"],
                    ['value' => '1', 'label' => "Interlocuteur ADETIS tout au long du séjour"],
                ],
                'sections' => [
                    [
                        'heading' => 'Pendant les études',
                        'paragraphs' => [
                            "Le titre de séjour étudiant se renouvelle chaque année sous réserve d'assiduité et de progression dans les études. Nous vous rappelons les échéances et vous aidons à réunir les justificatifs nécessaires (certificat de scolarité, relevés de notes, justificatifs de ressources).",
                        ],
                    ],
                    [
                        'heading' => 'Le droit au travail étudiant',
                        'paragraphs' => [
                            "Avec un VLS-TS validé ou une carte de séjour étudiant, vous pouvez travailler jusqu'à 964 heures par an, soit environ 60 % de la durée légale du travail — l'équivalent d'environ 20 heures par semaine en moyenne. L'employeur doit simplement effectuer une déclaration auprès de la préfecture avant l'embauche ; dépasser ce plafond peut compromettre le renouvellement de votre titre de séjour.",
                        ],
                    ],
                    [
                        'heading' => 'Après le diplôme : rester en France pour travailler',
                        'paragraphs' => [
                            "Selon votre nationalité et votre diplôme, vous pouvez solliciter une autorisation provisoire de séjour (APS, réservée à certains pays liés par accord bilatéral) ou une carte de séjour temporaire « recherche d'emploi / création d'entreprise » (RECE), valable 12 mois et non renouvelable. Pendant cette période, vous pouvez chercher un emploi correspondant à votre formation ou créer une entreprise, tout en conservant le droit de travailler dans la limite de 964 heures jusqu'à la signature d'un contrat définitif.",
                        ],
                    ],
                    [
                        'heading' => 'Notre accompagnement continu',
                        'paragraphs' => [
                            "Nous restons votre interlocuteur unique pour anticiper chaque échéance administrative, sécuriser vos renouvellements de titre et vous orienter, le moment venu, vers les bonnes démarches pour prolonger votre séjour ou entamer une carrière professionnelle en France.",
                        ],
                    ],
                ],
                'faq' => [
                    ['q' => "Puis-je changer de statut étudiant vers salarié pendant mes études ?", 'a' => "Un changement de statut est possible sous conditions, notamment si vous obtenez une promesse d'embauche ou un contrat correspondant à un niveau de qualification suffisant. Nous étudions chaque situation au cas par cas."],
                    ['q' => "Que faire si mon titre de séjour arrive bientôt à expiration ?", 'a' => "Il faut engager la démarche de renouvellement plusieurs semaines avant l'échéance. Nous vous alertons en amont et vous accompagnons dans la constitution du dossier."],
                    ['q' => "L'autorisation de recherche d'emploi est-elle automatique après le diplôme ?", 'a' => "Non, elle doit être demandée activement, avec des critères de diplôme et parfois de nationalité. Nous vérifions votre éligibilité et vous accompagnons dans la constitution de la demande."],
                ],
            ],
        ];

        $features = [];
        foreach ($list as $feature) {
            $features[$feature['slug']] = $feature;
        }

        return $features;
    }
}
