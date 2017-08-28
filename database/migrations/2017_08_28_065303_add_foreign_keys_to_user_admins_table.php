<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_admins', function(Blueprint $table)
		{
			$table->foreign('status_id', 'FK_user_admins_status_id_statuses')->references('id')->on('statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_admins', function(Blueprint $table)
		{
			$table->dropForeign('FK_user_admins_status_id_statuses');
		});
	}

}
