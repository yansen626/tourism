<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_details', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('transaction_id', 36)->index('FK_trx_details_trx_id_trxs_idx');
			$table->string('product_id', 36)->index('FK_trx_details_product_id_products_idx');
			$table->string('name', 100)->nullable();
			$table->integer('weight')->nullable();
			$table->float('price_basic', 10, 0)->nullable();
			$table->integer('discount')->nullable();
			$table->float('discount_flat', 10, 0)->nullable();
			$table->float('price_final', 10, 0)->nullable();
			$table->integer('quantity')->nullable();
			$table->float('subtotal_price', 10, 0)->nullable();
			$table->string('created_by', 36)->nullable();
			$table->dateTime('created_on')->nullable();
			$table->string('modified_by', 36)->nullable();
			$table->dateTime('modified_on')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transaction_details');
	}

}
