<?php

declare(strict_types=1);

/**
 * Crée un nouveau fichier de migration vide dans database/migrations/,
 * numéroté après le dernier existant :
 *
 *   composer make:migration -- add_wishlist_note_column
 *
 * Éditer le fichier généré pour y écrire le SQL (CREATE TABLE / ALTER
 * TABLE / ...), puis lancer `composer migrate` pour l'appliquer.
 */

$name = trim($argv[1] ?? '');

if ($name === '') {
    fwrite(STDERR, "Usage : composer make:migration -- <nom> (ex. add_wishlist_note_column)\n");
    exit(1);
}

$slug = strtolower(preg_replace('/[^A-Za-z0-9]+/', '_', $name) ?? '');
$slug = trim($slug, '_');

if ($slug === '') {
    fwrite(STDERR, "Nom de migration invalide.\n");
    exit(1);
}

$migrationsDir = dirname(__DIR__) . '/database/migrations';
$existing = glob($migrationsDir . '/*.sql') ?: [];

$last = 0;
foreach ($existing as $file) {
    if (preg_match('/^(\d+)_/', basename($file), $m)) {
        $last = max($last, (int) $m[1]);
    }
}

$number = str_pad((string) ($last + 1), 4, '0', STR_PAD_LEFT);
$filename = "{$number}_{$slug}.sql";
$path = "$migrationsDir/$filename";

file_put_contents($path, <<<SQL
    -- Migration : $slug

    SQL);

echo "Créé : database/migrations/$filename\n";
