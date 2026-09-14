<?php

namespace App\Core;

/**
 * Compteur de tentatives par fenêtre glissante, stocké en base (le process
 * PHP ne survit pas entre deux requêtes) — pour limiter l'abus des
 * formulaires publics et de l'API (spam, brute force) sans dépendance
 * externe (Redis/APCu). Nécessite la table `rate_limits` (cf. migration
 * d'exemple).
 */
class RateLimiter
{
    /**
     * @return bool true si la tentative est autorisée (et comptabilisée), false si le quota est déjà atteint.
     */
    public static function attempt(string $key, int $maxAttempts, int $decaySeconds): bool
    {
        $pdo = Database::connection();

        $pdo->prepare('
            INSERT INTO rate_limits (rl_key, attempts, expires_at)
            VALUES (:key, 1, DATE_ADD(NOW(), INTERVAL :decay SECOND))
            ON DUPLICATE KEY UPDATE
                attempts = IF(expires_at < NOW(), 1, attempts + 1),
                expires_at = IF(expires_at < NOW(), DATE_ADD(NOW(), INTERVAL :decay2 SECOND), expires_at)
        ')->execute(['key' => $key, 'decay' => $decaySeconds, 'decay2' => $decaySeconds]);

        $stmt = $pdo->prepare('SELECT attempts FROM rate_limits WHERE rl_key = :key');
        $stmt->execute(['key' => $key]);
        $attempts = (int) $stmt->fetchColumn();

        return $attempts <= $maxAttempts;
    }
}
