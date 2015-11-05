<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCruisesCabinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruises_cabins', function (Blueprint $table) {
            $table->integer('cabin_id')->references('id')->on('cabins');
            $table->integer('cruise_id')->references('id')->on('cruises');
            $table->integer('cabin_number');
            $table->integer('cabin_booked');
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
        Schema::drop('cruises_cabins');
    }
}
