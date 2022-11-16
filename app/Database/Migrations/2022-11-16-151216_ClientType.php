<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientType extends Migration
{
    public function up()
    {
        $this->forge->addField([
           'id' => [
               'type' => 'INT',
               'auto_increment' => true
           ],
            'type_name' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ]
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('client_type',true, ['engine' => 'innodb']);
    }

    public function down()
    {
        $this->forge->dropTable('client_type');
    }
}
