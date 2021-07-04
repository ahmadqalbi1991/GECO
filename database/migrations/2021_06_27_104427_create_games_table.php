<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('game_name');
            $table->enum('game_type', ['action', 'rpg', 'mmo', 'action_adventure', 'adventure', 'simulation', 'strategy', 'puzzle', 'idle']);
            $table->date('release_date');
            $table->text('description');
            $table->string('image');
            $table->boolean('tournament_allow');
            $table->boolean('is_active');
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
        Schema::dropIfExists('games');
    }
}
