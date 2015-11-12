<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPromotionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->integer('promotion_id');
        });
        Schema::table('cabins', function (Blueprint $table) {
            $table->integer('promotion_id');
        });
        Schema::table('cruises', function (Blueprint $table) {
            $table->integer('promotion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropColumn('promotion_id');
        });
        Schema::table('cabins', function (Blueprint $table) {
            $table->dropColumn('promotion_id');
        });
        Schema::table('cruises', function (Blueprint $table) {
            $table->dropColumn('promotion_id');
        });
    }
}
