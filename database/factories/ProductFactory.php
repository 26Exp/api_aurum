<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

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
    public function definition()
    {
        App::setLocale('ru');
        $ru  = [
            'name_ru' => $this->faker->lastName(),
            'slug_ru' => Str::slug($this->faker->word),
            'description_ru' => $this->faker->realText,
            'meta_title_ru' => $this->faker->word,
            'meta_description_ru' => $this->faker->realText,
        ];

        App::setLocale('ro');
        $ro  = [
            'name_ro' => $this->faker->lastName(),
            'slug_ro' => Str::slug($this->faker->word),
            'description_ro' => $this->faker->realText,
            'meta_title_ro' => $this->faker->word,
            'meta_description_ro' => $this->faker->realText,
        ];

        $general = [
            'manufacturer_id' => 1,
            'category_id' => 1,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'sale_price' => $this->faker->randomFloat(2, 0, 100),
            'sku' => $this->faker->numberBetween(10000, 99999),
            'status' => Product::STATUS_PUBLISHED,
            'weight' => $this->faker->randomFloat(2, 0, 100),
            'has_variation' => Product::HAS_NO_VARIATION,
            'has_discount' => Product::HAS_NO_DISCOUNT,
            'has_badge' => Product::HAS_NO_BADGE,
        ];

        return array_merge($ru, $ro, $general);
    }
}
