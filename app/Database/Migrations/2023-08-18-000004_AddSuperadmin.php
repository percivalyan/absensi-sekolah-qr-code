<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Myth\Auth\Password;

class AddSuperadmin extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'is_superadmin' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 0,
                'after'      => 'username'
            ],
            'role_label' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'is_superadmin'
            ]
        ]);

        // Insert initial super admin with role_label
        $email = 'adminsuper@gmail.com';
        $username = 'superadmin';
        $password = 'superadmin';

        $encryptedPassword = Password::hash($password);

        $this->forge->getConnection()->query(
            "INSERT INTO users (email, username, is_superadmin, role_label, password_hash, active) 
            VALUES ('$email', '$username', 1, 'Super Admin', '$encryptedPassword', 1)"
        );
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'is_superadmin');
        $this->forge->dropColumn('users', 'role_label');
    }
}
