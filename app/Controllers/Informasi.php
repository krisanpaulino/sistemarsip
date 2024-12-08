<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InformasiModel;

class Informasi extends BaseController
{
    public function index()
    {
        $model = new InformasiModel();
        $data = [
            'informasi' => $model->orderBy('informasi_id', 'desc')->find(),
            'title' => 'Informasi'
        ];
        return view('informasi_index', $data);
    }
    function create()
    {
        $model = new InformasiModel();

        $data = [
            'title' => 'Tambah Informasi',
            'informasi' => $model
        ];
        return view('informasi_form', $data);
    }
    function edit($informasi_id)
    {
        $model = new InformasiModel();

        $data = [
            'title' => 'Tambah Informasi',
            'informasi' => $model->find($informasi_id)
        ];
        return view('informasi_form', $data);
    }
    function save()
    {
        $informasi_id = $this->request->getPost('informasi_id');

        $model = new InformasiModel();
        $data = [
            'informasi_id' => $this->request->getPost('informasi_id'),
            'informasi_judul' => $this->request->getPost('informasi_judul'),
            'informasi_isi' => $this->request->getPost('informasi_isi'),
        ];
        $file = $this->request->getFile('file');
        if ($informasi_id == null) {
            if (!$informasi_id = $model->insert($data, true))
                return redirect()->back()->with('danger', 'Terjadi kesalahan saat menyimpan data')->withInput()->with('errors', $model->errors());
            $data['informasi_id'] = $informasi_id;
        }

        //Handling file uploaded
        if ($file != null && $file->isValid()) {
            $path = './assets/files';
            $filename = 'file_' . $informasi_id . '.' . $file->getExtension();
            if (!$file->move($path, $filename, true)) {
                $model->where('informasi_id', $informasi_id)->delete();
                return redirect()->back()->with('danger', 'Kesalahan saat upload file')->withInput();
            }
            $data['informasi_dokumen'] = $filename;
        }
        // dd($data);

        if (!$model->save($data))
            return redirect()->back()->with('danger', 'Terjadi kesalahan saat menyimpan data')->withInput()->with('errors', $model->errors());
        return redirect()->to('admin/informasi')->with('success', 'Data informasi berhasil disimpan!');
    }
    function delete()
    {
        $informasi_id = $this->request->getPost('id');
        $model = new InformasiModel();
        if (!$model->where('informasi_id', $informasi_id)->delete())
            return redirect()->back()->with('danger', 'Gagal menghapus data')->withInput()->with('errors', $model->errors());
        return redirect()->to('admin/informasi')->with('success', 'Data informasi berhasil dihapus!');
    }
}
