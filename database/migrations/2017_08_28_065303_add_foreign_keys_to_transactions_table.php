<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transactions', function(Blueprint $table)
		{
			$table->foreign('address_id', 'FK_transactions_address_id_addresses')->references('id')->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('courier_id', 'FK_transactions_courier_id_couriers')->references('id')->on('couriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('delivery_type_id', 'FK_transactions_delivery_type_id_delivery_types')->references('id')->on('delivery_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_method_id', 'FK_transactions_payment_method_id_payment_methods')->references('id')->on('payment_methods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'FK_transactions_status_id_statuses')->references('id')->on('statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'FK_transactions_user_id_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transactions', function(Blueprint $table)
		{
			$table->dropForeign('FK_transactions_address_id_addresses');
			$table->dropForeign('FK_transactions_courier_id_couriers');
			$table->dropForeign('FK_transactions_delivery_type_id_delivery_types');
			$table->dropForeign('FK_transactions_payment_method_id_payment_methods');
			$table->dropForeign('FK_transactions_status_id_statuses');
			$table->dropForeign('FK_transactions_user_id_users');
		});
	}

}
