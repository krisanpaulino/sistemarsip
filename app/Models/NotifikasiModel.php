<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'notifikasi';
    protected $primaryKey       = 'notifikasi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'notifikasi_id',
        'notifikasi_judul',
        'notifikasi_isi',
        'notifikasi_baca',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'notifikasi_judul' => 'required',
        'notifikasi_isi' => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function getUnread()
    {
        $this->where('notifikasi_baca', '0');
        return $this->find();
    }

    function read($id)
    {
        $this->where('notifikasi_id', $id);
        $this->set('notifikasi_baca', '1');
        return $this->update();
    }
}
