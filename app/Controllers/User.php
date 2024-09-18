<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OperatorModel;
use App\Models\UnitModel;
use App\Models\UserModel;

class User extends BaseController
{
    function index()
    {
        $model = new UserModel();
        $data = [
            'title' => 'Data User',
            'user' => $model->findActive()
        ];
        return view('user/index', $data);
    }
    public function signup()
    {
        // dd(session('user'));
        $user = new UserModel();
        $unitModel = new UnitModel();
        $unit = $unitModel->getUnits();
        $data = [
            'title' => 'User',
            'user' => $user,
            'unit' => $unit
        ];
        return view('user/form', $data);
    }
    function register()
    {
        $data = $this->request->getPost();
        $model = new UserModel();
        if (!$id = $model->insert($data))
            // dd($model->errors());
            return redirect()->back()->with('danger', 'Gagal!')->with('errors', $model->errors());
        if ($data['user_tipe'] == 'operator') {
            $operator = [
                'operator_nama' => $data['operator_nama'],
                'unit_id' => $data['unit_id'],
                'user_id' => $id,
                'operator_aktif' => '1'
            ];
            $opModel = new OperatorModel();
            if (!$opModel->insert($operator)) {
                $model->where('user_id', $id)->delete();
                // dd($opModel->errors());
                return redirect()->back()->with('danger', 'Gagal menambahkan data operator');
            }
        }
        return redirect()->back()->with('success', 'Berhasil!');
    }
    function gantiPassword()
    {
        $user = user();
        $data = [
            'user' => $user,
            'title' => 'Ganti Password',
        ];
        return view('user/gantipassword', $data);
    }
    function updatePassword()
    {
        // $user_id = user()->user_id;
        $current_password = $this->request->getPost('current_password');
        $model = new UserModel();
        $user = user();
        //cek validasi password 
        if (!password_verify($current_password, $user->user_password))
            return redirect()->back()->with('danger', 'Password anda salah');
        $data = [
            'user_password' => $this->request->getPost('user_password'),
            'password_confirmation' => $this->request->getPost('password_confirmation')
        ];
        // dd($user);
        $model->where('user_id', session('user')->user_id);
        $model->set($data);
        if (!$model->update())
            // dd($model->errors());
            return redirect()->back()->with('danger', 'Konfirmasi password tidak sama')->with('errors', $model->errors());

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}
