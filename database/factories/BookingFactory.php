<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingFactory extends Factory {
	protected $model = Booking::class;

	public function definition() {
		return [
			'start_date'   => Carbon::now(),
			'end_date'     => Carbon::now(),
			'status'       => $this->faker->word(),
			'base_fee'     => $this->faker->randomFloat(),
			'deposit'      => $this->faker->randomFloat(),
			'cleaning_fee' => $this->faker->randomFloat(),
			'late_fee'     => $this->faker->randomFloat(),
			'damage_fee'   => $this->faker->randomFloat(),
			'total_amount' => $this->faker->randomFloat(),
			'returned_at'  => Carbon::now(),
			'created_at'   => Carbon::now(),
			'updated_at'   => Carbon::now(),

			'customer_id' => Customer::factory(),
			'product_id'  => Product::factory(),
		];
	}
}
