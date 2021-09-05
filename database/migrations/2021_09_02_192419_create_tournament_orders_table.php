<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('tournament_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('tournament_id')->on('tournaments')->references('id');
            $table->smallInteger('points')->default(0)->nullable();
            $table->enum('team_status', ['winner', 'defeat', 'draw']);
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
        Schema::dropIfExists('tournament_orders');
    }
}
