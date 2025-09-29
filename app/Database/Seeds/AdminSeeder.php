<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'name' => 'Admin',
            'email' => 'admin@dataentry.com',
            'password' => password_hash('12345',PASSWORD_BCRYPT),
            'role' => 1,
            'status' => 1,
        );

        $this->db->table('admins')->insert($data);
    }
}
