<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_name' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'category_id' =>[
                'type' => 'INT',
                'constraint' => '11',
            ],
            'price' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'discount' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'discount_type' =>[
                'type' => 'INT',
                'constraint' => '11',
                'comment' =>'0 => No Discount,1 => Discount in %,2 => Discount in Rs',
            ],
            'offer_price' =>[
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'size' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'weight' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'image' =>[
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' =>[
                'type' => 'longtext',
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
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
