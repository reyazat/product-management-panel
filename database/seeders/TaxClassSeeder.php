<?php

namespace Database\Seeders;

use App\Models\TaxClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaxClass::create([
            'name' => 'مالیات بر ارزش افزوده',
            'rate' => 20.0,
            'type' => 'P',
            'status' => 1,
        ]);
        TaxClass::create([
            'name' => 'غیر مشمول',
            'rate' => 0.0,
            'type' => 'P',
            'status' => 1,
        ]);
    }
}
