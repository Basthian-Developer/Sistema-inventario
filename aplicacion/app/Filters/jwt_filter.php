<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class jwt_filter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Se llama al helper del JWT previamente preparado
        helper('jwt');
        $jwtService = service('jwtService');
        $cookiesService = service('cookiesService');

        $token = $cookiesService->obtenerCookie('access_token');

        $datos = $jwtService->validarJWT($token);

        if (!$datos) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON(['error' => 'Token invalido o expirado']);
        }

        $request->user = $datos;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
