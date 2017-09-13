<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDeliveryTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delivery_types', function(Blueprint $table)
		{
			$table->foreign('courier_id', 'FK_delivery_types_courier_id_couriers')->references('id')->on('couriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delivery_types', function(Blueprint $table)
		{
			$table->dropForeign('FK_delivery_types_courier_id_couriers');
		});
	}

}
