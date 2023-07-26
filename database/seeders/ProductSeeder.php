<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Option;
use App\Models\OptionProduct;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TargetMarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $options = Option::factory(3)->create()->each(function ($option) {
            OptionValue::factory(3)->create([
                'option_id' => $option->id,
            ]);
        });

        $categories = Category::factory(4)->create();
        Product::factory(5)->create()->each(function ($product) use ($categories, $options) {
            $product->categories()->sync($categories->random(2));
            $product->customerGroups()->sync([
                TargetMarket::pluck('id')->random() => ['price' => fake()->numerify('##.##'), 'quantity' => fake()->randomNumber()]
            ]);
            $optId = $options->pluck('id')->random();

            $product->options()->sync([
                $optId => [
                    'required' => collect([1,0])->random(),
                    'value'=> fake()->name(),
                ]
            ]);
            $product->optionValues()->sync([
                OptionValue::where('option_id','=',$optId)->pluck('id')->random() => [
                    'option_id' => $optId,
                    'price' => fake()->numerify('##.##'),
                    'quantity'=> fake()->numerify('##'),
                    'point' => fake()->numerify('##'),
                    'price_prefix' => collect(['+', '-'])->random(),
                    'point_prefix' => collect(['+', '-'])->random(),
                ]
            ]);

            $product->relatedProducts()->sync(Product::where('id', '!=', $product->id)->pluck('id')->random(3));
            ProductImage::create([
                'product_id' => $product->id,
                'file_name' => fake()->imageUrl()
            ]);
        });
    }
}
