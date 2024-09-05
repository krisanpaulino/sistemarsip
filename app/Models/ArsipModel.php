<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'arsip';
    protected $primaryKey       = 'arsip_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'jenis_id',
        'arsip_nomor',
        'arsip_tanggalarsip',
        'arsip_tanggalrekam',
        'unit_id',
        'deleted',
        'arsip_file',
        'arsip_perihal'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'jenis_id' => 'required',
        'arsip_nomor' => 'required',
        'arsip_tanggalarsip' => 'required',
        'unit_id' => 'required',
        'arsip_perihal' => 'required'
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

    function getArsip($arsip_id = null)
    {
        $this->join('jenis', 'jenis.jenis_id = arsip.jenis_id');
        $this->join('unit', 'unit.unit_id = arsip.unit_id');
        if ($arsip_id != null) {
            $this->where('arsip_id', $arsip_id);
            return $this->first();
        }

        return $this->find();
    }
    function byUnit($unit_id)
    {
        $this->join('jenis', 'jenis.jenis_id = arsip.jenis_id');
        $this->join('unit', 'unit.unit_id = arsip.unit_id');
        $this->where('arsip.unit_id', $unit_id);
        return $this->find();
    }
    function getNotUnit()
    {
        $this->join('jenis', 'jenis.jenis_id = arsip.jenis_id');
        $this->join('unit', 'unit.unit_id = arsip.unit_id');
        $unit_id = user()->unit_id;
        $this->whereNotIn('arsip.unit_id', [$unit_id]);
        return $this->find();
    }
}
