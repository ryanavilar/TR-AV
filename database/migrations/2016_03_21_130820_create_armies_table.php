<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('archer');
            $table->integer('swordsman');
            $table->integer('horseman');
            $table->integer('archerLv');
            $table->integer('swordsmanLv');
            $table->integer('horsemanLv');
            $table->integer('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('army');
    }
}
