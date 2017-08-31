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
			$table->timestamps('created_at')->nullable();
			$table->string('created_by', 36)->nullable();
			$table->timestamps('updated_at')->nullable();
			$table->string('updated_by', 36)->nullable();
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
