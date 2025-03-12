<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOperatortoArsip extends Migration
{
    public function up()
    {
        $this->forge->addColumn('arsip', [
            'operator_id' => [
                'type' =>  'INT',
                'default' => null,
                'null' => true
            ],
            'CONSTRAINT fk_operator_id_arsip FOREIGN KEY (operator_id) REFERENCES operator(operator_id) on delete cascade on update cascade'
        ]);
    }

    public function down()
    {
        //
    }
}
