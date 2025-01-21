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
        'operator_id',
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
        'operator_id' => 'required',
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
        $this->select('pinjam.*, arsip.*, jenis.*, unit.*, a.unit_id as unit_asal_id, a.unit_nama as unit_asal, operator.operator_nama');
        $this->join('unit', 'unit.unit_id = pinjam.unit_id');
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id');
        $this->join('unit a', 'a.unit_id = arsip.unit_id');
        $this->join('jenis', 'arsip.jenis_id = jenis.jenis_id');
        $this->join('operator', 'operator.operator_id = pinjam.operator_id', 'left');
        if (session('user')->user_tipe == 'operator') {
            $this->where('pinjam.unit_id', user()->unit_id);
            $this->where('pinjam.operator_id', user()->operator_id);
        } else
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
        $this->join('operator', 'operator.operator_id = pinjam.operator_id', 'left');
        return $this->find();
    }

    function cekPinjam($unit_id, $arsip_id)
    {
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id and pinjam.arsip_id = ' . $arsip_id, 'right');
        $this->join('operator', 'operator.operator_id = pinjam.operator_id', 'left');
        $this->where('pinjam.unit_id', $unit_id);
        // $this->where('pinjam.arsip_id', $arsip_id);
        $this->groupStart();
        $this->where('pinjam_approved', '1')
            ->where('pinjam_sampai >=', date('Y-m-d'), true)->groupEnd();
        $this->orWhere('pinjam.pinjam_approved', 'unchecked');
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
        $this->select('pinjam.*, arsip.*, jenis.*, unit.*, a.unit_id as unit_pinjam_id, a.unit_nama as unit_pinjam, operator.operator_nama');
        $this->join('operator', 'operator.operator_id = pinjam.operator_id', 'left');
        $this->join('unit', 'unit.unit_id = pinjam.unit_id');
        $this->join('arsip', 'arsip.arsip_id = pinjam.arsip_id');
        $this->join('unit a', 'a.unit_id = arsip.unit_id');
        $this->join('jenis', 'arsip.jenis_id = jenis.jenis_id');
        $this->where('pinjam.pinjam_approved', 'unchecked');
        $result = $this->find();
        return $result;
    }

    function getCountRequest()
    {
        if (user()->user_tipe == 'operator') {
            $this->where(user()->user_tipe);
        }

        $this->where('pinjam.pinjam_approved', 'unchecked');
        $result = $this->countAllResults();
        return $result;
    }

    function getCount($days = null, $unit_pinjam = null, $unit_asal = null)
    {
        $this->join('arsip asal', 'asal.arsip_id = pinjam.arsip_id');
        if ($days != null) {
            $currdate = date('Y-m-d');
            $from_date = date('Y-m-d', strtotime($currdate . ' - ' . $days . ' day'));
            $this->where('pinjam_waktu <=', $currdate, true);
            $this->where('pinjam_waktu >=', $from_date, true);
        }
        if ($unit_pinjam != null) {
            $this->where('pinjam.unit_id', $unit_pinjam);
        }
        if ($unit_pinjam != null) {
            $this->where('asal.unit_id', $unit_asal);
        }
        // dd($this->builder()->getCompiledSelect());
        return $this->countAllResults();
    }
}
