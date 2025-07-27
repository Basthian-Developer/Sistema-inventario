<?php

namespace App\Controllers\Vistas;

use App\Controllers\BaseController;

class Home_View extends BaseController
{
    public function index(): string
    {
        return view('login_view');
    }
}
