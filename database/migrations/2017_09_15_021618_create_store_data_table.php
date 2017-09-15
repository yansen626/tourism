<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_data', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('address')->nullable();
			$table->integer('province_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->integer('subdistrict_id')->nullable();
			$table->string('subdistrict_name', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('store_data');
	}

}
