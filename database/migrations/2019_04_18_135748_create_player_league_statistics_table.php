<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerLeagueStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_league_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->integer('league_id')->unsigned();
			$table->integer('goals');
			$table->integer('penalties');
			$table->integer('yellowcards');
			$table->integer('redcards');
			$table->integer('ratings');
            $table->timestamps();
        });

        Schema::table('player_league_statistics', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_league_statistics', function(Blueprint $table) {
			$table->dropForeign('player_league_statistics_user_id_foreign');
		});

        Schema::dropIfExists('player_league_statistics');
    }
}
