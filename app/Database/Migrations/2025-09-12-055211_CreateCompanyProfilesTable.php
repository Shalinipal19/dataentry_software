<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompanyProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'company_email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true, 
            ],
            'company_contact' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'company_whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'company_address' => [
                'type' => 'TEXT',
            ],
            'facebook_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true, 
            ],
            'instagram_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'linkedin_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'youtube_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'twitter_link' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'company_logo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'company_favicon' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('company_profiles');
    }

    public function down()
    {
        $this->forge->dropTable('company_profiles');
    }
}
