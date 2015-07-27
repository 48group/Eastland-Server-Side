<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_cat', function(Blueprint $table)
		{
			$table->increments('id');
            $table->bigInteger('shopId')->unsigned()->index();
            $table->bigInteger('catId')->unsigned()->index();
			$table->timestamps();

            $table->foreign('shopId')
                ->references('id')
                ->on('shops')
                ->onDelete('cascade');

            $table->foreign('catId')
                ->references('id')
                ->on('cat')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shop_cat');
	}

}
