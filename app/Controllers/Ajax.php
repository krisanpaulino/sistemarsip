<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotifikasiModel;
use App\Models\PinjamModel;

class Ajax extends BaseController
{
    public function notifikasi()
    {
        $model = new NotifikasiModel();
        $notifikasi = $model->getUnread();
        echo json_encode($notifikasi);
    }
    function read($id)
    {
        $model = new NotifikasiModel();
        $model->read($id);
        $data = ['message' => 'success'];
        echo json_encode($data);
        // return redirect()->to('admin/pinjam/request');
    }

    function newPinjam()
    {
        $model = new PinjamModel();
        $count = $model->getCountRequest();
        $data['count'] = $count;
        echo json_encode($data);
    }
}
