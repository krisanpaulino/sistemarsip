<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->has('user'))
            return redirect()->to('auth');
        if (session('user')->user_tipe == 'admin')
            return view('dashboard_admin');
        else
            return view('dashboard_operator');
    }
}
