<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database with the admin user.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'nome' => 'admin',
            'email' => 'admin@gmail.com',
            'data_nasc' => '1990-01-01',
            'cpf' => '12345678910',
            'password' => bcrypt('123123123'),
            'tipo' => 'admin',
            'funcao' => 'administrador',
        ]);

        // Outros usuários, se necessário...
    }
}