<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('league_id')->unsigned()->nullable();
			$table->integer('stadium_id')->unsigned();
			$table->integer('type_id')->unsigned()->nullable();
			$table->integer('group_id')->unsigned()->nullable();
			$table->integer('team1')->unsigned();
			$table->integer('team2')->unsigned();
			$table->datetime('datetime');
			$table->integer('winner')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('matches', function(Blueprint $table) {
			$table->foreign('league_id')->references('id')->on('leagues')
						->onDelete('restrict')
						->onUpdate('cascade');
        });
        Schema::table('matches', function(Blueprint $table) {
			$table->foreign('stadium_id')->references('id')->on('stadiums')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->foreign('type_id')->references('id')->on('types')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->foreign('team1')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->foreign('team2')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->foreign('winner')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function(Blueprint $table) {
			$table->dropForeign('matches_league_id_foreign');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->dropForeign('matches_stadium_id_foreign');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->dropForeign('matches_type_id_foreign');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->dropForeign('matches_group_id_foreign');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->dropForeign('matches_team1_foreign');
		});
		Schema::table('matches', function(Blueprint $table) {
			$table->dropForeign('matches_team2_foreign');
		});
        Schema::dropIfExists('matches');
    }
}
