<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('user_id', 36)->index('FK_transactions_user_id_users_idx');
			$table->integer('payment_method_id')->index('FK_transactions_payment_method_id_payment_methods_idx');
			$table->integer('payment_code')->nullable();
			$table->float('total_payment', 10, 0)->nullable();
			$table->float('total_price', 10, 0)->nullable();
			$table->integer('address_id')->nullable()->index('FK_transactions_address_id_addresses_idx');
			$table->integer('courier_id')->nullable()->index('FK_transactions_courier_id_couriers_idx');
			$table->integer('delivery_type_id')->nullable()->index('FK_transactions_delivery_type_id_delivery_types_idx');
			$table->float('delivery_fee', 10, 0)->nullable();
			$table->float('admin_fee', 10, 0)->nullable();
			$table->integer('status_id')->nullable()->index('FK_transactions_status_id_statuses_idx');
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
		Schema::drop('transactions');
	}

}
