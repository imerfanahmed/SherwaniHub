<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up() {
		Schema::create( 'products', function ( Blueprint $table ) {
			$table->id();
			$table->string( 'name' );
			$table->string( 'sku' );
			$table->string( 'size' );
			$table->string( 'color' );
			$table->float( 'rental_price' );
			$table->string( 'status' );
			$table->string( 'condition_notes' );
			$table->timestamps();
		} );
	}

	public function down() {
		Schema::dropIfExists( 'products' );
	}
};
