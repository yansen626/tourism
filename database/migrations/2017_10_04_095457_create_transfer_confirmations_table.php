<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransferConfirmationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfer_confirmations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user_id', 36)->nullable()->index('FK_transfer_confirmations_user_id_users_idx');
			$table->string('transaction_id', 36)->nullable()->index('FK_transfer_confirmations_trx_id_transactions_idx');
			$table->string('receiver_bank', 30)->nullable();
			$table->float('transfer_amount', 10, 0)->nullable();
			$table->string('sender_name', 50)->nullable();
			$table->dateTime('transfer_date')->nullable();
			$table->text('note')->nullable();
			$table->integer('status_id')->index('FK_transfer_confirmation_status_id_statuses_idx');
			$table->dateTime('created_on')->nullable();
			$table->string('created_by', 36)->nullable();
			$table->dateTime('modified_on')->nullable();
			$table->string('modified_by', 36)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transfer_confirmations');
	}

}
