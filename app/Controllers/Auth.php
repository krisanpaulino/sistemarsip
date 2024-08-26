<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('login2', ['title' => 'Login Kepegawaian UNWIRA']);
    }
    public function login()
    {
        dd('');
        $username = $this->request->getPost('username');
        $password = (string)$this->request->getPost('user_password');
        $model = new UserModel();
        $user = $model->findUser($username);
        if (empty($user))
            return redirect()->back()->with('danger', 'User tidak ditemukan. Hubungi admin!');
        if (!password_verify($password, $user->user_password))
            return redirect()->back()->with('danger', 'Password Salah. Hubungi admin!');
        // dd($user);
        session()->set('user', $user);
        switch ($user->user_tipe) {
            case 'admin':
                # code...
                return redirect()->to('dashboard');
                break;

            case 'operator':
                # code...
                return redirect()->to('dashboard');
                break;
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth');
    }
    // public function blocked()
    // {
    //     return view('blocked');
    // }
}
