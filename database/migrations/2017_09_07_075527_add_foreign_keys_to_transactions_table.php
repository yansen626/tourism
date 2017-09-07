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
			$table->foreign('city_id', 'FK_transactions_city_id_cities')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('payment_method_id', 'FK_transactions_payment_method_id_payment_methods')->references('id')->on('payment_methods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('province_id', 'FK_transactions_province_id_provinces')->references('id')->on('provinces')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('FK_transactions_city_id_cities');
			$table->dropForeign('FK_transactions_payment_method_id_payment_methods');
			$table->dropForeign('FK_transactions_province_id_provinces');
			$table->dropForeign('FK_transactions_status_id_statuses');
			$table->dropForeign('FK_transactions_user_id_users');
		});
	}

}
