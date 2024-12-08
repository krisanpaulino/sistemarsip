<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiModel;

class Home extends BaseController
{
    public function index()
    {
        $infoM = new InformasiModel();
        // $info = model(InformasiModel::class);
        $data = [
            'title' => 'BKD Kabupaten Sikka',
            'informasi' => $infoM->getInformasi(),
            'pager' => $infoM->pager
        ];
        return view('front_landing', $data);
    }
}
