<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleryImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_images', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('gallery_id')->nullable()->index('FK_gallery_images_gallery_id_galleries_idx');
			$table->string('file_name', 50)->nullable();
			$table->integer('position')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gallery_images');
	}

}
