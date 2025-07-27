<?php

namespace App\Services\Jwt;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JwtService
{
    protected $key;

    public function __construct()
    {
        $this->key = getenv('JWT_SECRET');

        if(!$this->key){
            throw new \RuntimeException('JWT_SECRET no esta definido en el entorno');
        }
    }

    public function obtenerJWT(?object $data)
    {
        try {
            if (!empty($data)) {
                $tiempoActual = time();

                $accessExpirationTime = $tiempoActual + 600;
                $refreshExpirationTime = $tiempoActual + 604800;

                $payloadAccess = array(
                    'iat' => $tiempoActual,
                    'exp' => $accessExpirationTime,
                    'data' => $data,
                );

                $payloadRefresh = array(
                    'iat' => $tiempoActual,
                    'exp' => $refreshExpirationTime,
                    'data' => $data,
                );

                $accessToken = JWT::encode($payloadAccess, $this->key, 'HS256');
                $refreshToken = JWT::encode($payloadRefresh, $this->key, 'HS256');

                return [
                    'access' => $accessToken,
                    'refresh' => $refreshToken,
                ];
            }

            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function validarJWT(string $token)
    {
        try {
            if (!empty($token)) {
                $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
                return (array) $decoded->data;
            }

            return null;
        } catch (Exception $e) {
            return null;
        }
    }
}
