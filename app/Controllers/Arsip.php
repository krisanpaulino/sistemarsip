<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use App\Models\JenisModel;
use App\Models\UnitModel;

class Arsip extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();
        $data['title'] = 'Data Arsip';
        if (session('user')->user_tipe == 'admin')
            $data['arsip'] = $model->getArsip();
        else
            $data['arsip'] = $model->byUnit(session('user')->unit_id);
        return view('arsip_index', $data);
    }
    function tambahArsip()
    {
        $arsip = new ArsipModel();
        $unitModel = new UnitModel();
        $jenisModel = new JenisModel();
        $data = [
            'title' => 'Tambah Arsip',
            'arsip' => $arsip,
            'unit' => $unitModel->getUnits(),
            'jenis' => $jenisModel->getJenis()
        ];
        return view('arsip_form', $data);
    }
}
