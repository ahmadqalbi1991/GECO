<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageInTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->string('image')->after('rules')->nullable();
            $table->boolean('is_active')->after('rules')->default(0);
            $table->tinyInteger('status')->after('rules')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('is_active');
            $table->dropColumn('status');
        });
    }
}
