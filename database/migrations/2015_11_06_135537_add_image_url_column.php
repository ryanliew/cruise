<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageUrlColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cruises', function (Blueprint $table) {
            $table->text('image');
        });
        Schema::table('cabins', function (Blueprint $table) {
            $table->text('image');
        });
        Schema::table('amenities', function (Blueprint $table) {
            $table->text('image');
        });
        Schema::table('promotions', function (Blueprint $table) {
            $table->text('image');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->text('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cruises', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('cabins', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
