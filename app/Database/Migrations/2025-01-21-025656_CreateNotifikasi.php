<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotifikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'notifikasi_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'notifikasi_judul' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'notifikasi_isi' => [
                'type' => 'TEXT'
            ],
            'notifikasi_url' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'notifikasi_baca' => [
                'type' => 'ENUM',
                'constraint' => ['1', '0'],
                'default' => '0'
            ],
        ]);
        $this->forge->addPrimaryKey('notifikasi_id');
        $this->forge->createTable('notifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('notifikasi');
    }
}
