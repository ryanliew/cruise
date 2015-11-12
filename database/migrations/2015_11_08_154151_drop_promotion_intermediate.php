<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPromotionIntermediate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('amenities_promotions');
        Schema::drop('cabins_promotions');
        Schema::drop('reservations_amenities');
        Schema::drop('reservations_cabins');
        Schema::create('cabin_reservation', function (Blueprint $table) {
            $table->integer('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->integer('cabin_id')->references('id')->on('cabins');
            $table->integer('cabin_amount');
            $table->timestamps();
        });
        Schema::create('amenity_reservation', function (Blueprint $table) {
            $table->integer('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->integer('amenity_id')->references('id')->on('amenities');
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
        Schema::table('amenities_promotions', function (Blueprint $table) {
            //
        });
    }
}
