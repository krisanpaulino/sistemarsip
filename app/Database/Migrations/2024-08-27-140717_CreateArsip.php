<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateArsip extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'arsip_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'jenis_id' => [
                'type' => 'INT'
            ],
            'arsip_nomor' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'arsip_tanggalarsip' => [
                'type' => 'DATE'
            ],
            'arsip_tanggalrekam' => [
                'type' => 'DATE',
                'default' => new RawSql('CURRENT_DATE')
            ],
            'unit_id' => [
                'type' => 'INT'
            ],
            'deleted' => [
                'type' => 'ENUM',
                'constraint' => ['0', '1'],
                'default' => '0'
            ]
        ]);
        $this->forge->addPrimaryKey('arsip_id');
        $this->forge->addForeignKey('jenis_id', 'jenis', 'jenis_id', 'cascade', 'cascade');
        $this->forge->addForeignKey('unit_id', 'unit', 'unit_id', 'cascade', 'cascade');
        $this->forge->createTable('arsip');
    }

    public function down()
    {
        $this->forge->dropTable('arsip');
    }
}
