<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPerihaltoArsip extends Migration
{
    public function up()
    {
        $this->forge->addColumn('arsip', [
            'arsip_perihal' => [
                'type' => 'VARCHAR',
                'constraint' => '125'
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
