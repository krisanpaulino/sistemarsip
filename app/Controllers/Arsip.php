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
    function tambah()
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
    function save()
    {
        $data = $this->request->getPost();
        $model = new ArsipModel();
        //Insert Data untuk dapat ID
        if ($data['id'] == null) {
            if (!$id = $model->insert($data, true))
                return redirect()->back()->with('danger', 'Gagal! data tidak valid')->with('errors', $model->errors())->withInput();
        } else {
            $id = $data['id'];
        }

        $validationRule = [
            'file' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf]',
                ],
            ],
        ];
        if (! $this->validateData($data, $validationRule)) {
            $model->where('arsip_id', $id);
            $model->delete();
            $data = ['errors' => $this->validator->getErrors()];
            dd($data['errors']);
        }

        $file = $this->request->getFile('file');

        if (! $file->hasMoved()) {
            // $filepath = WRITEPATH . 'uploads/' . $file->store();
            $filename = 'arsip_' . $id . '.' . $file->getClientExtension();
            if (!$file->move(WRITEPATH . 'uploads/', $filename, true)) {
                if ($data['id'] == null) { //IF INSERT
                    $model->where('arsip_id', $id);
                    $model->delete();
                }
                return redirect()->back()->with('danger', 'Gagal! file gagal diupload')->withInput();
            }
            $data['arsip_file'] = $filename;
            $model->where('arsip_id', $id);
            $model->set($data);
            if (!$model->update())
                dd('error updating data');
        } else {
            $model->where('arsip_id', $id);
            $model->delete();
            return redirect()->to('arsip')->with('danger', 'Gagal! Terjadi kesalahan saat mengupload file!');
        }
        return redirect()->to(user()->user_tipe . 'arsip')->with('success', 'Data arsip berhasil disimpan!');
    }
}
