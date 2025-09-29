<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFormDataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'  => true,
                'auto_increment' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'   => true, 
            ],
            'form_data' => [
                'type' => 'TEXT', 
                'null' => false,
            ],
            'status' =>[
                'type' => 'TINYINT',
                'constraint' => 4,
                'default' => 1,
                'comment' =>'1=>Active,2=>Deactive',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('form_data');
    }

    public function down()
    {
        $this->forge->dropTable('form_data');
    }
}
