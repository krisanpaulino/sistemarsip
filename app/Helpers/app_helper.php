<?php

use App\Models\UserModel;

function user()
{
    $model = new UserModel();
    $model->select('user.*, operator.operator_id, operator.operator_nama, operator.operator_nip, unit.unit_id, unit.unit_nama');
    $model->join('operator', 'operator.user_id = user.user_id', 'left');
    $model->join('unit', 'unit.unit_id = operator.unit_id', 'left');
    $user = $model->where('user.user_id', session('user')->user_id)->first();
    return $user;
}
