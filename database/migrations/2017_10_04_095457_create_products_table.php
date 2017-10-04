<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->integer('category_id')->nullable()->index('FK_products_category_id_categories_idx');
			$table->string('name', 100);
			$table->float('price', 10, 0);
			$table->integer('discount')->nullable();
			$table->float('discount_flat', 10, 0)->nullable();
			$table->float('price_discounted', 10, 0)->nullable();
			$table->integer('quantity')->nullable();
			$table->integer('weight')->nullable();
			$table->text('description')->nullable();
			$table->integer('status_id')->index('FK_products_status_id_statuses_idx');
			$table->string('created_by', 36)->nullable();
			$table->dateTime('created_on')->nullable();
			$table->string('modified_by', 36)->nullable();
			$table->dateTime('modified_on')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
