<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGalleryImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery_images', function(Blueprint $table)
		{
			$table->foreign('gallery_id', 'FK_gallery_images_gallery_id_galleries')->references('id')->on('galleries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gallery_images', function(Blueprint $table)
		{
			$table->dropForeign('FK_gallery_images_gallery_id_galleries');
		});
	}

}
