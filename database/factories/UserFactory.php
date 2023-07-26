<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   $type = collect(['real','legal']);
        return [
            'fullname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'mobile' => fake()->phoneNumber(),
            'mobile_verified_at' => now(),
            'terms' => 1,
            'company' => fake()->company(),
            'company_signatory' => fake()->lastName().' , '.fake()->lastName(),
            'Identity' => fake()->numerify('##########'),
            'phone' => fake()->phoneNumber(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'postcode' => fake()->numerify('##########'),
            'taxcode' => fake()->numerify('##########'),
            'address' => fake()->address(),
            'role' => 'User',
            'status' => collect([0,1])->random(),
            'remember_token' => Str::random(10),
            'type' => $type->random()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
