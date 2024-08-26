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
        $username = $this->request->getPost('username');
        $password = (string)$this->request->getPost('password');
        $model = new UserModel();
        $user = $model->findUser($username);
        if (empty($user))
            return redirect()->to('auth')->with('danger', 'User tidak ditemukan. Hubungi admin!');
        // dd($password);
        if (!password_verify($password, $user->user_password))
            return redirect()->to('auth')->with('danger', 'Password Salah. Hubungi admin!');
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
