<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->integer('player_id_match')->unsigned()->nullable();
			$table->integer('player_id_league')->unsigned()->nullable();
			$table->integer('stadium_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('player_id_match')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('player_id_league')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('stadium_id')->references('id')->on('stadiums')
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
        Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_user_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_player_id_match_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_player_id_league_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_stadium_id_foreign');
		});

        Schema::dropIfExists('ratings');
    }
}
