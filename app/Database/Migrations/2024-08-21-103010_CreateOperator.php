<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOperator extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'operator_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'operator_nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'unit_id' => [
                'type' => 'INT',
            ],
            'operator_aktif' => [
                'type' => 'ENUM',
                'constraint' => [
                    '1',
                    '0'
                ],
                'default' => '1'
            ],
            'user_id' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addPrimaryKey('operator_id');
        $this->forge->addForeignKey('unit_id', 'unit', 'unit_id', 'cascade', 'cascade');
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'cascade', 'cascade');
        $this->forge->createTable('operator');
    }

    public function down()
    {
        $this->forge->dropTable('operator');
    }
}
