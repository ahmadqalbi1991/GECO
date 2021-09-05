<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTeamStatusIntournamentOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `tournament_orders` CHANGE `team_status` `team_status` ENUM('pending', 'in_game','winner','defeat','draw')");
    }
}
