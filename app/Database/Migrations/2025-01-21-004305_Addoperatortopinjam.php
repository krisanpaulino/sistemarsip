<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addoperatortopinjam extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pinjam', [
            'operator_id' => [
                'type' =>  'INT',
            ],
            'CONSTRAINT fk_operator_id_pinjam FOREIGN KEY (operator_id) REFERENCES operator(operator_id) on delete cascade on update cascade'
        ]);
    }

    public function down()
    {
        //
    }
}
