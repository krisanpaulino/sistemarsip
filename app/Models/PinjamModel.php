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
        $this->select('pinjam.*, arsip.*, jenis.*, unit.*, a.unit_id as unit_asal_id, a.unit_nama as unit_asal');
        $this->join('unit', 'unit.unit_id = pinjam.unit_id');
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id');
        $this->join('unit a', 'a.unit_id = arsip.unit_id');
        $this->join('jenis', 'arsip.jenis_id = jenis.jenis_id');
        if (session('user')->user_tipe == 'operator')
            $this->where('pinjam.unit_id', user()->unit_id);
        else
            $this->where('pinjam_approved != ', 'unchecked', true);
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
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id and pinjam.arsip_id = ' . $arsip_id, 'right');
        $this->where('pinjam.unit_id', $unit_id);
        // $this->where('pinjam.arsip_id', $arsip_id);
        $this->where('pinjam_approved', '1');
        $this->where('pinjam_sampai >=', date('Y-m-d'), true);
        // $this->orWhere('pinjam.unit_id', $unit_id);
        $result = $this->first();
        // dd($result);
        if (empty($result))
            return false;
        else
            return $result;
    }

    function getRequest()
    {
        if (user()->user_tipe == 'operator') {
            $this->where(user()->user_tipe);
        }
        $this->select('pinjam.*, arsip.*, jenis.*, unit.*, a.unit_id as unit_pinjam_id, a.unit_nama as unit_pinjam');
        $this->join('unit', 'unit.unit_id = pinjam.unit_id');
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id');
        $this->join('unit a', 'a.unit_id = arsip.unit_id');
        $this->join('jenis', 'arsip.jenis_id = jenis.jenis_id');
        $this->where('pinjam.pinjam_approved', 'unchecked');
        $result = $this->find();
        return $result;
    }

    function getCount($days = null)
    {
        if ($days != null) {
            $currdate = date('Y-m-d');
            $from_date = date('Y-m-d', strtotime($currdate . ' - ' . $days . ' day'));
            $this->where('pinjam_waktu <=', $currdate, true);
            $this->where('pinjam_waktu >=', $from_date, true);
        }
        // dd($this->builder()->getCompiledSelect());
        return $this->countAllResults();
    }
}
