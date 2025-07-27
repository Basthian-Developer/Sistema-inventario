<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Exception;

class AuthController extends BaseController
{
    public function login()
    {
        $dbService = service('databaseService');
        $responseService = service('responseService');
        $jwtService = service('jwtService');
        $cookiesService = service('cookiesService');
        $request = service('request');
        
        $input = $request->getJSON(true);

        $username = $input['username'] ?? null;
        $password = $input['password'] ?? null;

        if (!empty($username) && !empty($password)) {
            try {
                /*$cookie_refresh = $cookiesService->obtenerCookie('refresh_token');

                if(!empty($cookie_refresh)){
                    $token = $jwtService->validarJWT($cookie_refresh);

                    if(!empty($token) || $dbService->buscarUsuarioByUsername($token['nombre_usuario'])){
                        return $responseService->retornarJSON($this->response, 'La sesión no se ha cerrado, puedes volver', 200);
                    }
                }*/

                $result = $dbService->buscarUsuarioByUsername($username);
                if (!empty($result) && password_verify($password, $result->pass_usuario)) {
                    $token = $jwtService->obtenerJWT($result);

                    if (empty($token)) {
                        return $responseService->retornarJSON($this->response, 'Error al generar los tokens', 500);
                    }

                    $cookiesService->guardarCookie('access_token', $token['access'], 600);
                    $cookiesService->guardarCookie('refresh_token', $token['refresh'], 1200);

                    $dbService->registrarMovimiento($username, 'Ha iniciado sesión');

                    return $responseService->retornarJSON($this->response, 'Iniciando sesión', 200);
                }

                return $responseService->retornarJSON($this->response, 'Credenciales invalidas', 401);
            } catch (Exception $e) {
                return $responseService->retornarJSON($this->response, 'Error interno: ' . $e, 500);
            }
        }
        return $responseService->retornarJSON($this->response, 'No pueden quedar campos vacios', 400);
    }

    public function logout()
    {
        $dbservice = service('databaseService');
        $responseService = service('responseService');
        $jwtService = service('jwtService');
        $cookiesService = service('cookiesService');

        $token = $cookiesService->obtenerCookie('refresh_token');

        if (!empty($token)) {
            $data = $jwtService->validarJWT($token);

            if (!empty($data)) {
                $dbservice->registrarMovimiento($data['nombre_usuario'], 'Ha cerrado sesión');
                $cookiesService->eliminarCookie('access_token');
                $cookiesService->eliminarCookie('refresh_token');

                return $responseService->retornarJSON($this->response, 'Sesión cerrada correctamente', 200);
            }

            return $responseService->retornarJSON($this->response, 'Error al cerrar la sesión');
        }
    }

    public function renovarAccessToken()
    {
        $dbService = service('databaseService');
        $responseService = service('responseService');
        $jwtService = service('jwtService');
        $cookiesService = service('cookiesService');

        $refresh_token = $cookiesService->obtenerCookie('refresh_token');

        if (!empty($refresh_token)) {
            $payload = $jwtService->validarJWT($refresh_token);

            $usuario = $dbService->buscarUsuarioByUsername($payload['nombre_usuario']);

            if (empty($usuario)) {
                return $responseService->retornarJSON($this->response, 'Refresh token invalido', 401);
            }

            $nuevo_access_token = $jwtService->obtenerJWT($usuario);

            if (!empty($nuevo_access_token)) {
                $cookiesService->guardarCookie('access_token', $nuevo_access_token['access'], 600);

                return $responseService->retornarJSON($this->response, 'Nuevo token generado', 200);
            }

            return $responseService->retornarJSON($this->response, 'Error al generar el nuevo token', 500);
        }
    }
}
