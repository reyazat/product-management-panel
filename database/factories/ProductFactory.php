<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\TaxClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'sku'=> fake()->unique()->word(),
            'short_description'=> fake()->sentence(),
            'description'=> fake()->text(),
            'tags'=> fake()->word(),
            'image'=> fake()->imageUrl(),
            'price'=> fake()->numerify('##.##'),
            'supplier_price'=> fake()->numerify('##.##'),
            'weight'=> fake()->numerify('##.##'),
            'length'=> fake()->numerify('##.##'),
            'width'=> fake()->numerify('##.##'),
            'height'=> fake()->numerify('##.##'),
            'date_available'=> now(),
            'quantity'=> fake()->randomNumber(),
            'minimum'=> fake()->randomNumber(),
            'tax_class_id'=> TaxClass::pluck('id')->random(),
            'manufacturer_id'=> Manufacturer::factory(2)->create()->pluck('id')->random(),
            'meta_title'=> fake()->word(),
            'meta_description'=> fake()->text(),
            'status'=> 1,
        ];
    }
}
