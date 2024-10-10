<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNiptoOperator extends Migration
{
    public function up()
    {
        $this->forge->addColumn('operator', [
            'operator_nip' => [
                'type' =>  'VARCHAR',
                'constraint' => '20'
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
