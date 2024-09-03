<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pinjam';
    protected $primaryKey       = 'pinjam_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'unit_id',
        'arsip_id',
        'pinjam_waktu',
        'pinjam_approved',
        'pinjam_sampai',
        'pinjam_keterangan',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'unit_id' => 'required',
        'arsip_id' => 'required',
        // 'pinjam_waktu' => 'required',
        // 'pinjam_approved' => 'required',
        // 'pinjam_sampai' => 'required',
        'pinjam_keterangan' => 'required',
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

    function getPinjam($pinjam_id = null)
    {
        $this->join('unit', 'unit.unit_id = pinjam.unit_id');
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id');
        if (session('user')->user_tipe == 'operator')
            $this->where('pinjam.unit_id', user()->unit_id);
        if ($pinjam_id != null) {
            $this->where('pinjam_id', $pinjam_id);
            return $this->first();
        }
        return $this->find();
    }

    function byUnit($unit_id)
    {
        $this->where('pinjam.unit_id', $unit_id);
        $this->join('unit', 'unit.unit_id = pinjam.unit_id');
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id');
        return $this->find();
    }

    function cekPinjam($unit_id, $arsip_id)
    {
        $this->where('pinjam.unit_id', $unit_id);
        $this->where('pinjam.arsip_id', $arsip_id);
        $this->where('pinjam_approved', '1');
        $this->where('pinjam_sampai >=', date('Y-m-d'), false);
        $result = $this->first();
        if (empty('$result'))
            return false;
        else
            return $result;
    }
}
