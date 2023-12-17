<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nome' => 'admin',
            'email' => 'admin@gmail.com',
            'data_nasc' => '1990-01-01',
            'cpf' => '12345678910',
            'password' => static::$password ??= Hash::make('123123123'),
            'tipo' => 'admin',
            'funcao' => 'administrador',
            'created_at' => now(),
            'updated_at' => now(),
            ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
