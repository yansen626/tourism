<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('email', 100);
			$table->text('password');
			$table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('phone', 20)->nullable();
			$table->integer('status_id')->index('FK_users_status_id_statuses_idx');
			$table->string('email_token', 191)->nullable();
			$table->string('api_token', 191)->nullable();
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
		Schema::drop('users');
	}

}
