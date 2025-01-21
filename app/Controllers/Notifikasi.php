<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotifikasiModel;

class Notifikasi extends BaseController
{
    public function notif()
    {
        $model = new NotifikasiModel();
        $notifikasi = $model->getUnread();
        echo json_encode($notifikasi);
    }
    function read($id)
    {
        $model = new NotifikasiModel();
        $model->read($id);
        return redirect()->to('admin/pinjam/request');
    }
}
