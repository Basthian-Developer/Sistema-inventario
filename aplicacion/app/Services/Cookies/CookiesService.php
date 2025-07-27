<?php

namespace App\Services\Cookies;

use Exception;

class CookiesService
{
    public function guardarCookie(string $nombre, string $valor, int $duracionSegundos): bool
    {
        if (!empty($nombre) && !empty($valor) && $duracionSegundos > 0) {
            return setcookie(
                $nombre,
                $valor,
                [
                    'expires' => time() + $duracionSegundos,
                    'path' => '/',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict',
                ]
            );
        }

        return false;
    }

    public function guardarCookieCSRF(string $nombre, string $valor, int $duracionSegundos): bool
    {
        if (!empty($nombre) && !empty($valor) && $duracionSegundos > 0) {
            return setcookie(
                $nombre,
                $valor,
                [
                    'expires' => time() + $duracionSegundos,
                    'path' => '/',
                    'secure' => true,
                    'httponly' => false,
                    'samesite' => 'Strict',
                ]
            );
        }

        return false;
    }

    public function eliminarCookie(string $nombre): bool
    {
        return setcookie(
            $nombre,
            '',
            [
                'expires' => time() - 3600,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict',
            ]
        );
    }

    public function obtenerCookie(string $nombre): string
    {
        return $_COOKIE[$nombre] ?? null;
    }
}
