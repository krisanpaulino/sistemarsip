<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateInformasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'informasi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'informasi_judul' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'informasi_isi' => [
                'type' => 'TEXT'
            ],
            'informasi_waktu' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'informasi_dokumen' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('informasi_id');
        $this->forge->createTable('informasi');
    }

    public function down()
    {
        $this->forge->dropTable('informasi');
    }
}
