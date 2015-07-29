<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops' , function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('place');
            $table->string('phone1')->nullable();
            $table->text('info');
            $table->string('giftCard');
            $table->string('bestParking');
            $table->string('webSite')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('phone2')->nullable();
            $table->string('tradingHours')->nullable();
            $table->string('picture')->nullable();
            $table->string('categories')->nullable();
            $table->bigInteger('userId')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('userId')
            ->references('id')
            ->on('users')
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
        Schema::drop('shops');
    }

}
