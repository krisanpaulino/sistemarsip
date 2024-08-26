<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'unit_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'unit_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'deleted' => [
                'type' => 'ENUM',
                'constraint' => ['1', '0'],
                'default' => '0'
            ]
        ]);
        $this->forge->addPrimaryKey('unit_id');
        $this->forge->createTable('unit');
    }

    public function down()
    {
        $this->forge->dropTable('unit');
    }
}
