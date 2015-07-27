<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('shop_user' , function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('shopId')->unsigned()->index();
            $table->bigInteger('userId')->unsigned()->index();
            $table->timestamps();

            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('shopId')
                ->references('id')
                ->on('shops')
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
		Schema::drop('shop_user');
	}

}
