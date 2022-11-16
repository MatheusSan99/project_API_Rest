<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'product_id' => [
                'type' => 'INT'
            ],
            'client_id' => [
                'type' => 'INT'
            ],
            'status' => [
                'type' => 'INT'
            ],
            'total' => [
                'type' => 'FLOAT'
            ]
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('orders',true, ['engine' => 'innodb']);
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
