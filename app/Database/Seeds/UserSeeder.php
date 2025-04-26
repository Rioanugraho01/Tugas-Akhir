<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Admin Ima Catering',
            'username' => 'admin',
            'phone'    => '12341234',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
        ];

        // Insert data ke tabel users
        $this->db->table('users')->insert($data);
    }
}
