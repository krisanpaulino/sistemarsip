<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePinjam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pinjam_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'unit_id' => [
                'type' => 'INT'
            ],
            'arsip_id' => [
                'type' => 'INT'
            ],
            'pinjam_waktu' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'pinjam_approved' => [
                'type' => 'ENUM',
                'constraint' => ['1', '0', 'unchecked'],
                'default' => 'unchecked'
            ],
            'pinjam_sampai' => [
                'type' => 'DATE'
            ],
            'pinjam_keterangan' => [
                'type' => 'TEXT',
                'default' => NULL
            ]
        ]);
        $this->forge->addPrimaryKey('pinjam_id');
        $this->forge->addForeignKey('unit_id', 'unit', 'unit_id', 'cascade', 'cascade');
        $this->forge->addForeignKey('arsip_id', 'arsip', 'arsip_id', 'cascade', 'cascade');
        $this->forge->createTable('pinjam');
    }

    public function down()
    {
        $this->forge->dropTable('pinjam');
    }
}
