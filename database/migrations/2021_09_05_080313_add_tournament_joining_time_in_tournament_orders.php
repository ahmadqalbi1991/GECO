<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTournamentJoiningTimeInTournamentOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournament_orders', function (Blueprint $table) {
           $table->dateTime('tournament_joining_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournament_orders', function (Blueprint $table) {
            $table->dropColumn('tournament_joining_time');
        });
    }
}
