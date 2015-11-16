<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('cabin_id');
            $table->dropColumn('payment_id');
            $table->varchar('payment_id', 25);
        });
        Schema::table('amenity_reservation', function (Blueprint $table) {
            $table->integer('status');
        });
        Schema::drop('cabin_reservation');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
}
