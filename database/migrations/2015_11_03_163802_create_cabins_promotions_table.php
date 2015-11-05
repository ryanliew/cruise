<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabinsPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabins_promotions', function (Blueprint $table) {
            $table->integer('cabin_id')->references('id')->on('cabins');
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
        Schema::drop('cabins_promotions');
    }
}
