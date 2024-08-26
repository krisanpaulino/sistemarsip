<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJenis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jenis_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'jenis_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'delete' => [
                'type' => 'ENUM',
                'constraint' => ['1', '0'],
                'default' => '0'
            ]
        ]);
        $this->forge->addPrimaryKey('jenis_id');
        $this->forge->createTable('jenis');
    }

    public function down()
    {
        $this->forge->dropTable('jenis');
    }
}
