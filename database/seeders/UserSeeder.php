<?php

namespace Database\Seeders;

use App\Models\TargetMarket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\Passport;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $targetmarket = TargetMarket::factory(5)->create();

        User::factory(4)->create()->each(function ($user) use ($targetmarket) {
            $user->customergroups()->sync($targetmarket->random(2));
        });
    }
}
