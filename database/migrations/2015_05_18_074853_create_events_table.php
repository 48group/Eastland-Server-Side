<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events' , function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('time')->nullable();
            $table->string('info');
            $table->string('place');
            $table->string('picture')->nullable();
            $table->string('category');
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
        Schema::drop('events');
    }

}
