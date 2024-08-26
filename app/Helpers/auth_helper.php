<?php

use App\Models\MenuModel;
use App\Models\UsermenuModel;
use App\Models\UserModel;

function cekLogin()
{
    if (!session()->has('user')) {
        return redirect()->to('auth');
    }
    $role_id = session('user')->role_id;
    $uri = new \CodeIgniter\HTTP\URI(current_url());
    $menu_title = $uri->getSegment(1);
    $model = new MenuModel();
    $menu = $model->byTitle($menu_title);
    $menu_id = $menu->menu_id;
    $model = new UsermenuModel();
    $access = $model->findUsermenu($menu_id, $role_id);
    if (empty($access))
        return redirect()->to('auth/blocked');
}
function check_access($role_id, $menu_id)
{
    $model = new UsermenuModel();
    $result = $model->findUsermenu($menu_id, $role_id);
    if ($result != null) {
        return "checked='checked'";
    }
}
