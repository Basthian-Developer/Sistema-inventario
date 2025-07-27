<?php

namespace App\Controllers\Vistas;

use App\Controllers\BaseController;

class Dashboard_View extends BaseController
{
    public function index(): string
    {
        return View('dashboard_view');
    }
}
