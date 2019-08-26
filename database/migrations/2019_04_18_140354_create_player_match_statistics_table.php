<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerMatchStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_match_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->integer('match_id')->unsigned();
			$table->integer('goals');
			$table->string('yellowcards');
			$table->string('redcards');
			$table->integer('penalties');
			$table->boolean('man')->default(0);
			$table->integer('ratings');
            $table->timestamps();
        });

        Schema::table('player_match_statistics', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('player_match_statistics', function(Blueprint $table) {
			$table->foreign('match_id')->references('id')->on('matches')
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
        Schema::table('player_match_statistics', function(Blueprint $table) {
			$table->dropForeign('player_match_statistics_user_id_foreign');
		});
		Schema::table('player_match_statistics', function(Blueprint $table) {
			$table->dropForeign('player_match_statistics_match_id_foreign');
        });

        Schema::dropIfExists('player_match_statistics');
    }
}
