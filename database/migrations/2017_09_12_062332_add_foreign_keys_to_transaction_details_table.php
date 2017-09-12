<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransactionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transaction_details', function(Blueprint $table)
		{
			$table->foreign('product_id', 'FK_trx_details_product_id_products')->references('id')->on('products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('transaction_id', 'FK_trx_details_trx_id_trxs')->references('id')->on('transactions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transaction_details', function(Blueprint $table)
		{
			$table->dropForeign('FK_trx_details_product_id_products');
			$table->dropForeign('FK_trx_details_trx_id_trxs');
		});
	}

}
