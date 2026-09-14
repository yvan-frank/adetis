<?php

namespace App\Services;

use RuntimeException;

/**
 * Encodage/décodage JWT minimal (HS256), sans dépendance externe.
 * À remplacer par firebase/php-jwt via composer si besoin de robustesse accrue.
 *
 * Le secret vient uniquement de .env et le boot échoue si la valeur est
 * vide ou est restée à la valeur d'exemple "change-me" — jamais de secret
 * codé en dur dans le code source.
 */
class TokenService
{
    private static function secret(): string
    {
        $config = require dirname(__DIR__, 2) . '/config/config.php';
        $secret = $config['jwt']['secret'];

        if ($secret === '' || $secret === 'change-me') {
            throw new RuntimeException(
                'JWT_SECRET manquant ou non configuré : définissez une vraie valeur dans .env '
                . '(générer avec: php -r "echo bin2hex(random_bytes(32));")'
            );
        }

        return $secret;
    }

    public static function issue(array $payload, int $ttlSeconds = 86400): string
    {
        $header = self::base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload['iat'] = time();
        $payload['exp'] = time() + $ttlSeconds;
        $body = self::base64UrlEncode(json_encode($payload));

        $signature = self::base64UrlEncode(
            hash_hmac('sha256', "$header.$body", self::secret(), true)
        );

        return "$header.$body.$signature";
    }

    public static function verify(string $token): ?array
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            return null;
        }

        [$header, $body, $signature] = $parts;

        $expected = self::base64UrlEncode(
            hash_hmac('sha256', "$header.$body", self::secret(), true)
        );

        if (!hash_equals($expected, $signature)) {
            return null;
        }

        $payload = json_decode(self::base64UrlDecode($body), true);

        if (!$payload || ($payload['exp'] ?? 0) < time()) {
            return null;
        }

        return $payload;
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
