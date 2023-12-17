<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Chama o UserSeeder para criar o usuário administrador
        $this->call(UserSeeder::class);

        // Outros seeders, se necessário...
    }
}