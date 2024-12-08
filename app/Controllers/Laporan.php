<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use Dompdf\Dompdf;
use Dompdf\Options;

// use App\Models\PinjamModel;

class Laporan extends BaseController
{
    public function harian()
    {
        $tanggal = $this->request->getVar('tanggal');
        // dd($tanggal);
        if ($tanggal == null)
            $tanggal = date("Y-m-d");
        $model = new ArsipModel();
        $laporan = $model->laporanHarian($tanggal);
        $data = [
            'title' => 'Laporan Harian',
            'laporan' => $laporan,
            'tanggal' => $tanggal
        ];
        return view('laporan_harian', $data);
    }

    function cetakharian()
    {
        $tanggal = $this->request->getPost('tanggal');
        if ($tanggal == null)
            $tanggal = date("Y-m-d");
        $model = new ArsipModel();
        $laporan = $model->laporanHarian($tanggal);
        $data = [
            'title' => 'Laporan Harian',
            'laporan' => $laporan,
            'tanggal' => $tanggal
        ];
        $filename = $tanggal . '-laproran-upload';

        // instantiate and use the dompdf class
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);

        // load HTML content
        $dompdf->loadHtml(view('laporan_harianpdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        return $dompdf->stream($filename);
    }
    function bulanan()
    {
        $tanggal = $this->request->getVar('tanggal');
        if ($tanggal == null)
            $tanggal = date("Y-m");
        $bulan = date('m', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
        $model = new ArsipModel();
        $laporan = $model->laporanBulanan($bulan, $tahun);
        $data = [
            'title' => 'Laporan Bulan ' . $tanggal,
            'laporan' => $laporan,
            'tanggal' => $tanggal
        ];
        return view('laporan_bulan', $data);
    }
    function cetakbulanan()
    {
        $tanggal = $this->request->getPost('tanggal');
        if ($tanggal == null)
            $tanggal = date("Y-m-d");
        $model = new ArsipModel();
        $bulan = date('m', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
        $laporan = $model->laporanBulanan($bulan, $tahun);
        $data = [
            'title' => 'Laporan Bulan ' . $tanggal,
            'laporan' => $laporan,
            'tanggal' => $tanggal
        ];
        $filename = $tanggal . '-laproran-upload';
        // return view('laporan_bulananpdf', $data);
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);

        // load HTML content
        $dompdf->loadHtml(view('laporan_bulananpdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        return $dompdf->stream($filename);
    }
    function tahunan()
    {
        $tahun = $this->request->getVar('tahun');
        if ($tahun == null)
            $tahun = date("Y");
        $model = new ArsipModel();
        $laporan = $model->laporanTahunan($tahun);
        $data = [
            'title' => 'Laporan per Tahun',
            'laporan' => $laporan,
            'tahun' => $tahun
        ];
        return view('laporan_tahun', $data);
    }
    function cetaktahunan()
    {
        $tahun = $this->request->getPost('tahun');
        if ($tahun == null)
            $tahun = date("Y");
        $model = new ArsipModel();
        $laporan = $model->laporanTahunan($tahun);
        $data = [
            'title' => 'Laporan Rekam Arsip Tahunan',
            'laporan' => $laporan,
            'tahun' => $tahun
        ];
        $filename = $tahun . '-laproran-upload';

        // instantiate and use the dompdf class
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf();
        $dompdf->setOptions($options);

        // load HTML content
        $dompdf->loadHtml(view('laporan_tahunanpdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        return $dompdf->stream($filename);
    }
}
