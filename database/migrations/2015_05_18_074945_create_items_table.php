<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('picture');
            $table->string('price')->nullable();
            $table->string('info');
            $table->bigInteger('shopId')->unsigned()->index();
            $table->timestamps();
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
        Schema::drop('items');
    }

}
