<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banners', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('product_id', 36)->nullable()->index('FK_banners_product_id_products_idx');
			$table->integer('type')->nullable();
			$table->string('image_path', 191)->nullable();
			$table->string('url', 50)->nullable();
			$table->string('caption', 100)->nullable();
			$table->string('sub_caption', 100)->nullable();
			$table->integer('status_id')->nullable()->index('FK_banners_status_id_statuses_idx');
			$table->timestamps();
			$table->string('created_by', 36)->nullable()->index('FK_banners_created_by_user_admins_idx');
			$table->string('updated_by', 36)->nullable()->index('FK_banners_updated_by_user_admins_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('banners');
	}

}
