<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ManufacturerSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TaxClassSeeder::class,
            ProductSeeder::class,
        ]);

    }
}
