<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // dd(session('user'));
        $data['title'] = 'Dashboard';
        if (!session()->has('user'))
            return redirect()->to('auth');
        if (session('user')->user_tipe == 'admin')
            return view('dashboard_admin', $data);
        else
            return view('dashboard_operator', $data);
    }
}
