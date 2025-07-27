<?php

namespace App\Controllers\Csrf;

use App\Controllers\BaseController;

class CsrfController extends BaseController
{
    public function getCsrf()
    {
        //Retorno respuesta del token csrf con el nombre, para permitir comunicación con el backend
        return $this->response->setJSON([
            'token' => csrf_hash(),
            'name'  => csrf_token(),
        ]);
    }
}
