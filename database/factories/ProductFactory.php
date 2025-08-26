<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory {
	protected $model = Product::class;

	public function definition() {
		return [
			'name'            => $this->faker->name(),
			'sku'             => $this->faker->word(),
			'size'            => $this->faker->word(),
			'color'           => $this->faker->word(),
			'rental_price'    => $this->faker->randomFloat(),
			'status'          => $this->faker->word(),
			'condition_notes' => $this->faker->word(),
			'created_at'      => Carbon::now(),
			'updated_at'      => Carbon::now(),
		];
	}
}
