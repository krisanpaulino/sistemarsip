<?php

use App\Models\UserModel;

function user()
{
    $model = new UserModel();
    $user = $model->where('user_id', session('user')->user_id)->first();
    return $user;
}
