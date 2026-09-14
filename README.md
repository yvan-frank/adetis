# php-mvc-skeleton

Squelette PHP MVC natif (sans framework) + frontend React (Vite) en architecture "îles", extrait d'un projet en production. Base pour démarrer rapidement un nouveau projet PHP : routeur, migrations SQL, auth JWT, validation — et, si besoin, des composants React ponctuels injectés dans des pages PHP classiques (pas de SPA).

## Démarrage

```bash
cd backend
composer install
cp .env.example .env
# éditer .env (DB_*, JWT_SECRET — générer avec: php -r "echo bin2hex(random_bytes(32));")
composer migrate
php -S localhost:8000 -t public
```

Frontend (optionnel — seulement si des îles React sont utilisées) :

```bash
cd frontend
npm install
npm run dev
```

Avec les deux en marche, ouvrir `http://localhost:8000` : le layout PHP charge automatiquement les îles React depuis le serveur Vite (HMR actif). Sans serveur Vite lancé (APP_ENV != local, ou en prod), il charge le bundle buildé via `npm run build` dans `frontend/`.

## Structure

```
backend/
  config/                Config app + connexion DB (lit .env via App\Core\Env)
  database/migrations/   Une migration SQL par changement de schéma
  public/                Front controller (index.php) + .htaccess + assets buildés
  scripts/                migrate.php / make_migration.php
  src/Core/               Router, Request, Response, Database, Model, Controller,
                          Validator, Env, Assets (bascule dev Vite / bundle buildé)
  src/Middleware/         AuthMiddleware (JWT)
  src/Controllers/        Web + Api
  src/Services/           TokenService (JWT maison), PasswordHasher
  src/Models/             Un Model par table, extends App\Core\Model
  src/Views/              Templates PHP natifs (layout.php + content())
  src/routes.php          Toutes les routes

frontend/
  src/islands/            Un composant React par île (ex. Hello/index.jsx)
  src/lib/mountIsland.jsx Registre des îles + montage sur chaque [data-island]
  src/lib/apiClient.js    Client fetch vers /api (cookies inclus)
  vite.config.js          Build vers ../backend/public/assets/islands-runtime.js
```

## Conventions

- **Migrations obligatoires** : tout changement de schéma passe par `composer make:migration <nom>` puis `composer migrate`. Jamais d'édition directe d'un fichier schema.sql.
- **Router** : `$router->get('/produits/{id}', [ProductController::class, 'show'], [AuthMiddleware::class])`.
- **Controller** : `$this->view('nom', $data)` pour du HTML, `$this->json($data, $status)` pour une réponse API.
- **Model** : classe statique simple (`find`, `all`, `create`, `delete` hérités) — ajouter des méthodes spécifiques par requête métier, pas d'ORM.
- **Auth** : JWT signé HS256 maison (`App\Services\TokenService`), stocké en cookie httpOnly. Remplacer par `firebase/php-jwt` si besoin de robustesse accrue (algos multiples, rotation de clés...).
- **Îles React** : chaque `<div data-island="Nom" data-foo="bar">` dans une vue PHP est montée par `mountIsland.jsx`, qui passe les `data-*` en props. Ajouter une île = un dossier dans `frontend/src/islands/` + une entrée dans le registre de `mountIsland.jsx`. Pas de SPA, pas de routeur côté client : chaque page reste rendue par PHP, React ne prend que les zones interactives.
- **`public/index.php`** bufferise tout le dispatch pour afficher une page d'erreur propre (`Views/errors/database.php`) si la connexion DB tombe en cours de rendu, plutôt qu'un HTML à moitié généré.

## Ce qui n'est volontairement pas inclus

Pas de query builder, pas d'ORM, pas de container DI, pas de système de vues type Blade/Twig, pas de SPA côté React (pas de routeur client, pas de state manager global). Ce squelette reste minimal et lisible — ajouter ces briques projet par projet selon le besoin réel plutôt que par défaut.
