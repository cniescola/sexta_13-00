<?php

namespace Database\Seeders;

use App\Models\Cadastro;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gera dados aleatórios do Cadastro.
        Cadastro::factory(10)->create();

        // Mantém o exemplo de User como referência para o projeto.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
