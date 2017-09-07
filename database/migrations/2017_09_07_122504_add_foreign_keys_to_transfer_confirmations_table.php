<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransferConfirmationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transfer_confirmations', function(Blueprint $table)
		{
			$table->foreign('status_id', 'FK_transfer_confirmation_status_id_statuses')->references('id')->on('statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('trx_id', 'FK_transfer_confirmations_trx_id_transactions')->references('id')->on('transactions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'FK_transfer_confirmations_user_id_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transfer_confirmations', function(Blueprint $table)
		{
			$table->dropForeign('FK_transfer_confirmation_status_id_statuses');
			$table->dropForeign('FK_transfer_confirmations_trx_id_transactions');
			$table->dropForeign('FK_transfer_confirmations_user_id_users');
		});
	}

}
