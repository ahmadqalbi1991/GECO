<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGamesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `games` CHANGE `game_name` `game_name` VARCHAR(255) NULL, CHANGE `game_type` `game_type` ENUM('action','rpg','mmo','action_adventure','adventure','simulation','strategy','puzzle','idle') NULL, CHANGE `release_date` `release_date` DATE NULL, CHANGE `description` `description` TEXT NULL, CHANGE `image` `image` VARCHAR(255) NULL, CHANGE `tournament_allow` `tournament_allow` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `is_active` `is_active` TINYINT(1) NOT NULL DEFAULT '0'");
    }
}
