<?php

namespace App\Core;

use PDO;

abstract class Model
{
    protected static string $table = '';

    protected static function db(): PDO
    {
        return Database::connection();
    }

    public static function find(int $id): ?array
    {
        $stmt = self::db()->prepare('SELECT * FROM ' . static::$table . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public static function all(): array
    {
        return self::db()->query('SELECT * FROM ' . static::$table)->fetchAll();
    }

    public static function create(array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn ($key) => ":$key", array_keys($data)));

        $stmt = self::db()->prepare(
            'INSERT INTO ' . static::$table . " ($columns) VALUES ($placeholders)"
        );
        $stmt->execute($data);

        return (int) self::db()->lastInsertId();
    }

    public static function delete(int $id): void
    {
        $stmt = self::db()->prepare('DELETE FROM ' . static::$table . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
