<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'user_password',
        'user_tipe',
        'user_aktif',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username' => 'required|is_unique[user.username]',
        'user_password' => 'required',
        'user_password' => 'required|matches[user_password]',
        'user_tipe' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = ['hashPassword'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashPassword(array $data)
    {

        if (isset($data['data']['user_password'])) {
            $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_DEFAULT);
            // unset($data['data']['password']);
        }
        // dd($data);
        return $data;
    }
    function findUser($username)
    {
        $this->where('username', $username);
        $this->where('user_aktif', 1);
        return $this->first();
    }
    function findActive()
    {
        $this->join('operator', 'operator.user_id = user.user_id', 'left');
        $this->join('unit', 'unit.unit_id = operator.unit_id', 'left');
        $this->where('user_aktif', 1);
        return $this->find();
    }
}
