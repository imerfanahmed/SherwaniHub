<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CustomerFactory extends Factory {
	protected $model = Customer::class;

	public function definition() {
		return [
			'name'       => $this->faker->name(),
			'phone'      => $this->faker->phoneNumber(),
			'email'      => $this->faker->unique()->safeEmail(),
			'nid'        => $this->faker->word(),
			'address'    => $this->faker->address(),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		];
	}
}
