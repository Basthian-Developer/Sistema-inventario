<?php

namespace App\Services\Response;

use CodeIgniter\HTTP\ResponseInterface;

class ResponseService
{
    public function retornarJSON(ResponseInterface $response, string $mensaje, int $codigo): ResponseInterface
    {
        return $response
        ->setHeader(
            'X-CSRF-TOKEN', csrf_hash(),
        )
        ->setJSON(
            [
                'mensaje' => $mensaje,
                'status' => $codigo,
            ],
        );
    }
}
