<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('product_id', 36)->index('FK_carts_product_id_products_idx');
			$table->string('user_id', 36)->index('FK_carts_user_id_users_idx');
			$table->integer('quantity')->nullable();
			$table->float('total_price', 10, 0)->nullable();
			$table->integer('courier_id')->nullable()->index('FK_carts_courier_id_couriers_idx');
			$table->integer('delivery_type_id')->nullable()->index('FK_carts_delivery_type_id_delivery_types_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carts');
	}

}
