<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_types', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('courier_id')->index('FK_delivery_types_courier_id_couriers_idx');
			$table->string('description', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('delivery_types');
	}

}
