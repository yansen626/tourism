<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('galleries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 50);
			$table->integer('status_id')->default(1)->index('FK_galleries_status_id_statuses_idx');
			$table->timestamps();
			$table->string('created_by', 36)->nullable()->index('FK_galleries_created_by_user_admins_idx');
			$table->string('updated_by', 36)->nullable()->index('FK_galleries_updated_by_user_admins_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('galleries');
	}

}
