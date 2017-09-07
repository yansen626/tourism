<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user_id', 36)->index('FK_addresses_user_id_users_idx');
			$table->integer('province_id')->nullable();
			$table->string('province_name', 50)->nullable();
			$table->integer('city_id')->nullable();
			$table->string('city_name', 50)->nullable();
			$table->integer('subdistrict_id')->nullable();
			$table->string('subdistrict_name', 50)->nullable();
			$table->text('detail')->nullable();
			$table->integer('status_id')->index('FK_addresses_status_id_statuses_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
