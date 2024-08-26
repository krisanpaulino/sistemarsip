<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'user_password' => [
                'type' => 'TEXT'
            ],
            'user_tipe' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'operator']
            ],
            'user_aktif' => [
                'type' => 'ENUM',
                'constraint' => ['1', '0'],
                'default' => '1'
            ],
            'user_created' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ]
        ]);
        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
