<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class Master extends BaseController
{
    public function unit()
    {
        dd(session('user'));
        $model = new UnitModel();
        $unit = $model->getUnits();
        $data = [
            'title' => 'Data Unit',
            'unit' => $unit
        ];
        return view('master_unit', $data);
    }

    function saveunit()
    {
        $data = [
            'unit_nama' => htmlspecialchars($this->request->getPost('unit_nama')),
            'deleted' => '0'
        ];
        // dd($data);
        $model = new UnitModel();
        if (!$model->insert($data))
            // dd($model->errors());
            return redirect()->back()->with('danger', 'Data gagal disimpan!')->with('errors', $model->errors())->withInput();

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
    function deleteunit()
    {
        $unit_id = $this->request->getPost('id');
        $model = new UnitModel();
        $model->set('deleted', 1);
        $model->where('unit_id', $unit_id);
        if (!$model->update())
            return redirect()->back()->with('danger', 'Data gagal dihapus!')->with('errors', $model->errors())->withInput();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
