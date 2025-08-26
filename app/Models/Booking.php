<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
	use HasFactory;

	protected $fillable = [
		'customer_id',
		'product_id',
		'start_date',
		'end_date',
		'status',
		'base_fee',
		'deposit',
		'cleaning_fee',
		'late_fee',
		'damage_fee',
		'total_amount',
		'returned_at',
	];

	public function customer() {
		return $this->belongsTo( Customer::class );
	}

	public function product() {
		return $this->belongsTo( Product::class );
	}

	protected function casts() {
		return [
			'start_date'  => 'datetime',
			'end_date'    => 'datetime',
			'returned_at' => 'datetime',
		];
	}
}
