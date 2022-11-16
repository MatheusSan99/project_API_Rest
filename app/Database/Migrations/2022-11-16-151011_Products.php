<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
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
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'price' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'stock' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'tag' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('products',true, ['engine' => 'innodb']);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
