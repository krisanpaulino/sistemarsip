<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFiletoArsip extends Migration
{
    public function up()
    {
        $this->forge->addColumn('arsip', [
            'arsip_file' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
