<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ]
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('order_status',true, ['engine' => 'innodb']);
    }

    public function down()
    {
        $this->forge->dropTable('order_status');
    }
}
