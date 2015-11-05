<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsCabinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_cabins', function (Blueprint $table) {
            $table->integer('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->integer('cabin_id')->references('id')->on('cabins');
            $table->integer('cabin_amount');
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
        Schema::drop('reservations_cabins');
    }
}
