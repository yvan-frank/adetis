<?php

declare(strict_types=1);

/**
 * Applique les migrations de schéma en attente : `composer migrate` (ou
 * `php scripts/migrate.php`). Toute modification de la base (nouvelle
 * table, ALTER TABLE, ajout de colonne...) doit passer par un nouveau
 * fichier dans database/migrations/, créé via `composer make:migration <nom>`
 * (cf. scripts/make_migration.php) — jamais d'édition directe d'un schema.sql.
 *
 * Chaque fichier est un script SQL brut, exécuté une seule fois, dans
 * l'ordre de son préfixe numérique (0001_, 0002_, ...). L'historique
 * d'exécution est gardé dans la table `schema_migrations`.
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\Env;

Env::load(dirname(__DIR__) . '/.env');

$migrationsDir = dirname(__DIR__) . '/database/migrations';
$pdo = Database::connection();

$pdo->exec(<<<SQL
    CREATE TABLE IF NOT EXISTS schema_migrations (
        migration  VARCHAR(255) NOT NULL PRIMARY KEY,
        applied_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    SQL);

$files = glob($migrationsDir . '/*.sql') ?: [];
sort($files, SORT_STRING);

$applied = $pdo->query('SELECT migration FROM schema_migrations')->fetchAll(PDO::FETCH_COLUMN);
$insert = $pdo->prepare('INSERT INTO schema_migrations (migration) VALUES (:migration)');
$ran = 0;

foreach ($files as $file) {
    $name = basename($file);

    if (in_array($name, $applied, true)) {
        continue;
    }

    echo "Migration : $name ... ";

    try {
        $pdo->exec((string) file_get_contents($file));
        $insert->execute(['migration' => $name]);
        echo "OK\n";
        $ran++;
    } catch (\PDOException $e) {
        echo "ÉCHEC\n";
        fwrite(STDERR, $e->getMessage() . "\n");
        exit(1);
    }
}

if ($ran === 0) {
    echo "Rien à migrer — la base est à jour.\n";
} else {
    echo "Terminé : $ran migration(s) appliquée(s).\n";
}
