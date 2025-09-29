<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFieldsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'field_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'field_type' => [
                'type'       => "ENUM('text','number','date','dropdown','checkbox','radio')",
            ],
            'status' =>[
                'type' => 'TINYINT',
                'constraint' => 4,
                'default' => 1,
                'comment' =>'1=>Active,2=>Deactive',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' =>null,
            ],
            'updated_at' =>[
                'type' => 'TIMESTAMP',
                'null'=> true,
                'default' => null,
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
            ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('fields');
    }

    public function down()
    {
        $this->forge->dropTable('fields');
    }
}
