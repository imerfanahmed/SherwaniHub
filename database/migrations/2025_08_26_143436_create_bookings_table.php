<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up() {
		Schema::create( 'bookings', function ( Blueprint $table ) {
			$table->id();
			$table->foreignId( 'customer_id' );
			$table->foreignId( 'product_id' );
			$table->dateTime( 'start_date' );
			$table->dateTime( 'end_date' );
			$table->string( 'status' );
			$table->float( 'base_fee' );
			$table->float( 'deposit' );
			$table->float( 'cleaning_fee' );
			$table->float( 'late_fee' );
			$table->float( 'damage_fee' );
			$table->float( 'total_amount' );
			$table->dateTime( 'returned_at' );
			$table->timestamps();
		} );
	}

	public function down() {
		Schema::dropIfExists( 'bookings' );
	}
};
