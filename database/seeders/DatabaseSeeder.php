<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder para Categorías primero
        $this->call(\Database\Seeders\CategoriaSeeder::class);

        // Luego el seeder para Phones
        $this->call(\Database\Seeders\PhoneSeeder::class);
    }
}
