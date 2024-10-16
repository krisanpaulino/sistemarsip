<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use App\Models\PinjamModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // dd(session('user'));
        $arsipModel = new ArsipModel();
        $pinjamModel = new PinjamModel();
        $data['title'] = 'Dashboard';
        if (!session()->has('user'))
            return redirect()->to('auth');
        if (session('user')->user_tipe == 'admin') {
            $data['total_arsip'] = $arsipModel->where('deleted', '0')->countAllResults();
            $data['pinjam_30'] = $pinjamModel->getCount(30);
            $data['pinjam_365'] = $pinjamModel->getCount(365);
            $data['pinjam_all'] = $pinjamModel->getCount();
            return view('dashboard_admin', $data);
        } else
            return view('dashboard_operator', $data);
    }
}
