<?php

use App\Models\MenuModel;
use App\Models\SubmenuModel;

function menu($role_id)
{
    $model = new MenuModel();
    $menu = $model->findMenu($role_id);
    return $menu;
}

function submenu($menu_id)
{
    $model = new SubmenuModel();
    $submenu = $model->findSub($menu_id);
    return $submenu;
}
