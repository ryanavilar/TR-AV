<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('villageName');
            $table->integer('barrackLv');
            $table->integer('warehouseLv');
            $table->integer('hallLv');
            $table->integer('lumberLv');
            $table->integer('quarryLv');
            $table->integer('wheatLv');
            $table->integer('soilLv');
            $table->integer('Wood');
            $table->integer('Stone');
            $table->integer('Soil');
            $table->integer('Wheat');
            $table->integer('isOverlord');
            $table->integer('location')->unique();
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
        Schema::drop('villages');
    }
}
