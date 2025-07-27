<?php

namespace App\Controllers\Tablas;

use App\Controllers\BaseController;
use Exception;

class TablasController extends BaseController
{
    public function obtenerAuditoria()
    {
        try {
            $dbService = service('databaseService');
            $responseService = service('responseService');

            $datos = $dbService->obtenerAuditoria();

            if (empty($datos)) {
                return $responseService->retornarJSON($this->response, 'No hay datos que retornar', 200);
            }

            return $this->response->setJSON(
                [
                    'mensaje' => 'Datos encontrados',
                    'datos' => $datos,
                    'status' => 200,
                ]
            );
        } catch (Exception $e) {
            return $responseService->retornarJSON($this->response, 'Error al obtener la auditoria', 500);
        }
    }

    public function exportarAuditoria()
    {
        try {
            $responseService = service('responseService');
            $jwtService = service('jwtService');
            $cookiesService = service('cookiesService');
            $dbService = service('databaseService');

            $datos = $cookiesService->obtenerCookie('access_token');
            $autor = $jwtService->validarJWT($datos);
            $dbService->registrarMovimiento($autor['nombre_usuario'], 'Exporto la información de auditoria');
            
            return $responseService->retornarJSON($this->response,'La información ha sido exportada', 200);
        } catch (Exception $e) {
            return $responseService->retornarJSON($this->response, 'Error al exportar la información de auditoria', 500);
        }
    }
}
