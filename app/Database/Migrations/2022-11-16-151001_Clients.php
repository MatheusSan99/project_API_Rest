<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'adress' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'balance' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'trade_name' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'order_id' => [
                'type' => 'INT'
            ],
            'client_type_id' => [
                'type' => 'INT'
            ],

        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('clients',true, ['engine' => 'innodb']);
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
