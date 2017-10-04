<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('carts', function(Blueprint $table)
		{
			$table->foreign('courier_id', 'FK_carts_courier_id_couriers')->references('id')->on('couriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('delivery_type_id', 'FK_carts_delivery_type_id_delivery_types')->references('id')->on('delivery_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('product_id', 'FK_carts_product_id_products')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'FK_carts_user_id_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('carts', function(Blueprint $table)
		{
			$table->dropForeign('FK_carts_courier_id_couriers');
			$table->dropForeign('FK_carts_delivery_type_id_delivery_types');
			$table->dropForeign('FK_carts_product_id_products');
			$table->dropForeign('FK_carts_user_id_users');
		});
	}

}
