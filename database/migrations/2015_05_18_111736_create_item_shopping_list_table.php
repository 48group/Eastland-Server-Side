<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemShoppingListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('item_shopping_list' , function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('itemId')->unsigned()->index();
            $table->bigInteger('shoppingListId')->unsigned()->index();
            $table->timestamps();

            $table->foreign('itemId')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');

            $table->foreign('shoppingListId')
                ->references('id')
                ->on('shopping_lists')
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
		Schema::drop('item_shopping_list');
	}

}
