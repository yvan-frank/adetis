<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function connection(): PDO
    {
        if (self::$instance === null) {
            $config = require dirname(__DIR__, 2) . '/config/database.php';

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            try {
                self::$instance = new PDO($dsn, $config['user'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    // Fixe explicitement charset ET collation ici, pas
                    // seulement dans le DSN — sinon certains drivers
                    // négocient en utf8 (3 octets) contre des colonnes
                    // utf8mb4, corrompant tout texte accentué.
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '{$config['charset']}' COLLATE 'utf8mb4_unicode_ci'",
                ]);
            } catch (PDOException $e) {
                throw new PDOException('Connexion base de données impossible: ' . $e->getMessage(), (int) $e->getCode());
            }
        }

        return self::$instance;
    }
}
