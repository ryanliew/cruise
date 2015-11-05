<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities_promotions', function (Blueprint $table) {
            $table->integer('amenity_id')->references('id')->on('amenities');
            $table->integer('promotion_id')->references('id')->on('promotions');
            $table->date('promotion_start');
            $table->date('promotion_end');
            $table->boolean('active');
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
        Schema::drop('amenities_promotions');
    }
}
