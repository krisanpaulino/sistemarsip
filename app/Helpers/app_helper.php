<?php

use App\Models\PegawaiModel;
use App\Models\RiwayatdokumenModel;
use App\Models\RiwayatinpassingModel;
use App\Models\RiwayatjabatanModel;
use App\Models\RiwayatjafungModel;
use App\Models\RiwayatkepegawaianModel;
use App\Models\RiwayatpangkatModel;
use App\Models\RiwayatpelatihanModel;
use App\Models\RiwayatpendidikanModel;
use App\Models\UserModel;

function user()
{
    $model = new UserModel();
    $user = $model->join('role', 'role.role_id = user.role_id')->where('user_id', session('user')->user_id)->first();
    return $user;
}
function pegawai()
{
    $model = new PegawaiModel();
    return $model->where('user_id', session('user')->user_id)->first();
}
function checkNew($pegawai_id = null, $tabel = null)
{
    $ada_new = false;
    $new = [];
    if ($tabel == null) {
        $model = new RiwayatdokumenModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatdokumen'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;
        $model = new RiwayatpangkatModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatpangkat'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $model = new RiwayatpelatihanModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatpelatihan'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $model = new RiwayatpendidikanModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatpendidikan'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $model = new RiwayatkepegawaianModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatkepegawian'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $model = new RiwayatinpassingModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatinpassing'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $model = new RiwayatjabatanModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatjabatan'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $model = new RiwayatjafungModel();
        if ($pegawai_id != null)
            $model->where('pegawai_id', $pegawai_id);
        $riwayat = $model->where(['is_valid' => 'N', 'checked' => 'N'])->countAllResults();
        $new[0]['riwayatjafung'] = $riwayat;
        if ($riwayat > 0) $ada_new = true;

        $result = [
            'ada_new' => $ada_new,
            'new' => $new
        ];
        return $result;
    }
}
