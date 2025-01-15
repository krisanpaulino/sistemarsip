<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use App\Models\JenisModel;
use App\Models\PinjamModel;
use App\Models\UnitModel;
use CodeIgniter\Files\File;

// use CodeIgniter\Files\File;

class Arsip extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();
        $data['title'] = 'Data Arsip';
        if (session('user')->user_tipe == 'admin')
            $data['arsip'] = $model->getArsip();
        else
            $data['arsip'] = $model->byUnit(user()->unit_id);
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
        if (session('user')->user_tipe == 'operator')
            $data['unit_id'] = user()->unit_id;
        $model = new ArsipModel();
        //Insert Data untuk dapat ID
        if ($data['id'] == null) {
            if (!$id = $model->insert($data, true))
                // dd($model->errors());
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
            $update = ['arsip_file' => $filename];
            // dd($id);
            $model->where('arsip_id', $id);
            // $model->set($update);
            if (!$model->update($id, $update)) {
                dd('error updating data');
                $model->where('arsip_id', $id);
                $model->delete();
            }
        } else {
            $model->where('arsip_id', $id);
            $model->delete();
            return redirect()->to(user()->user_tipe . '/arsip')->with('danger', 'Gagal! Terjadi kesalahan saat mengupload file!');
        }
        return redirect()->to(user()->user_tipe . '/arsip')->with('success', 'Data arsip berhasil disimpan!');
    }

    function delete()
    {
        $id = $this->request->getPost('id');
        $model = new ArsipModel();
        //cek akses ke file.
        if (user()->user_tipe != 'admin') {
            $arsip = $model->where('arsip_id', $id)->where('unit_id', user()->unit_id)->countAllResults();
            if ($arsip <= 0) {
                return redirect()->to(user()->user_tipe . '/arsip')->with('danger', 'Anda tidak punya hak akses untuk file ini!');
            }
        }
        $model->where('arsip_id', $id);
        $model->set('deleted', '1');
        $model->update();
        return redirect()->to(user()->user_tipe . '/arsip')->with('success', 'Data arsip berhasil dihapus!');
    }
    function download()
    {
        $id = $this->request->getPost('id');
        $model = new ArsipModel();
        $arsip = $model->find($id);
        if ($arsip == null)
            return redirect()->back()->with('danger', 'Data arsip tidak ditemukan!');
        // $file = new File(WRITEPATH . 'uploads/' . $arsip->filename, true);
        // if (!$file)
        //     return redirect()->back()->with('danger', 'File tidak ditemukan!');
        // $file->getBasename();
        $filePath = WRITEPATH . 'uploads/' . $arsip->arsip_file;

        // Set the Content-Type header to application/octet-stream
        header('Content-Type: application/octet-stream');

        // Set the Content-Disposition header to the filename of the downloaded file
        header('Content-Disposition: attachment; filename="' . $arsip->arsip_file . '"');

        // Read the contents of the file and output it to the browser.
        readfile($filePath);
    }

    function pinjamIndex()
    {
        $model = new PinjamModel();
        $pinjam = $model->getPinjam();
        $data = [
            'title' => 'Data Pinjam Arsip',
            'pinjam' => $pinjam
        ];
        return view('pinjam_index', $data);
    }

    function pinjamForm()
    {
        $arsipModel = new ArsipModel();
        $arsip_pinjam = $arsipModel->getNotUnit();
        $data = [
            'title' => 'Form Pinjam Arsip',
            'arsip' => $arsip_pinjam
        ];
        return view('pinjam_form', $data);
    }

    function pinjam()
    {
        $unit_id = user()->unit_id;
        $arsip_id = $this->request->getPost('id');
        // $arsipModel = new ArsipModel();
        $pinjamModel = new PinjamModel();

        if ($pinjamModel->cekPinjam($unit_id, $arsip_id) != false)
            return redirect()->back()->with('danger', 'Anda masih memiliki akses untuk file ini ');

        $data = [
            'unit_id' => $unit_id,
            'arsip_id' => $arsip_id,
            'pinjam_waktu' => date('Y-m-d H:i:s'),
            'pinjam_keterangan' => htmlspecialchars($this->request->getPost('keterangan'))
        ];

        if (!$pinjamModel->insert($data))
            // dd($pinjamModel->errors());
            return redirect()->back()->with('danger', 'Periksa kembali data yang anda masukkan')->with('errors', $pinjamModel->errors());

        return redirect()->to('operator/pinjam')->with('success', 'Peminjaman anda berhasil direkam. Silahkan menunggu admin melakukan konfirmasi peminjaman anda.');
    }

    public function downloadPinjam()
    {
        $unit_id = user()->unit_id;
        $arsip_id = $this->request->getPost('id');
        $arsipModel = new ArsipModel();
        $pinjamModel = new PinjamModel();

        if ($pinjam = $pinjamModel->cekPinjam($unit_id, $arsip_id) == false) {
            // dd($pinjam);
            return redirect()->to(session('user')->user_tipe . '/pinjam')->with('danger', 'Anda tidak memiliki akses untuk file ini');
            exit;
        }
        $arsip = $arsipModel->find($arsip_id);
        if ($arsip == null)
            return redirect()->to(session('user')->user_tipe . '/pinjam')->with('danger', 'Data arsip tidak ditemukan!');
        // dd($arsip);
        $file = new File(WRITEPATH . 'uploads\\' . $arsip->arsip_file, true);
        if (!$file)
            return redirect()->back()->with('danger', 'File tidak ditemukan!');

        $filePath = WRITEPATH . 'uploads/' . $arsip->arsip_file;

        // Set the Content-Type header to application/octet-stream
        header('Content-Type: application/octet-stream');

        // Set the Content-Disposition header to the filename of the downloaded file
        header('Content-Disposition: attachment; filename="' . $arsip->arsip_file . '"');

        // Read the contents of the file and output it to the browser.
        readfile($filePath);
        // exit;
    }

    function requestPinjam()
    {
        $model = new PinjamModel();
        $pinjam = $model->getRequest();
        $data = [
            'title' => 'Permintaan Pinjam Arsip',
            'pinjam' => $pinjam
        ];
        return view('pinjam_request', $data);
    }

    function respondPinjam()
    {
        $id = $this->request->getPost('id');
        $action = $this->request->getPost('action');
        // dd($action);
        if ($action == 'approve') {
            $data['pinjam_approved'] = '1';
            $data['pinjam_sampai'] = $this->request->getPost('pinjam_tanggalsampai');
        } else {
            $data['pinjam_approved'] = '0';
        }
        // dd($this->request->getPost());
        $model = new PinjamModel();
        $model->where('pinjam_id', $id);
        $model->set($data);
        $model->update();
        return redirect()->back()->with('success', 'Permintaan berhasil diupdate');
    }
    function riwayatPinjam()
    {
        $model = new PinjamModel();
        $pinjam = $model->getPinjam();
        $data = [
            'title' => 'Data Pinjam Arsip',
            'pinjam' => $pinjam
        ];
        return view('pinjam_index', $data);
    }
    public function downloadUnit()
    {
        $unit_id = user()->unit_id;
        $arsip_id = $this->request->getPost('id');
        $model = new ArsipModel();

        $arsip = $model->where('arsip_id', $arsip_id)->where('unit_id', user()->unit_id)->countAllResults();
        if ($arsip <= 0) {
            return redirect()->to(user()->user_tipe . '/arsip')->with('danger', 'Anda tidak punya hak akses untuk file ini!');
        }
        $arsip = $model->find($arsip_id);
        if ($arsip == null)
            return redirect()->to(session('user')->user_tipe . '/arsip')->with('danger', 'Data arsip tidak ditemukan!');
        // dd($arsip);
        $file = new File(WRITEPATH . 'uploads\\' . $arsip->arsip_file, true);
        if (!$file)
            return redirect()->back()->with('danger', 'File tidak ditemukan!');

        $filePath = WRITEPATH . 'uploads/' . $arsip->arsip_file;

        // Set the Content-Type header to application/octet-stream
        header('Content-Type: application/octet-stream');

        // Set the Content-Disposition header to the filename of the downloaded file
        header('Content-Disposition: attachment; filename="' . $arsip->arsip_file . '"');

        // Read the contents of the file and output it to the browser.
        readfile($filePath);
        // exit;
    }
}
