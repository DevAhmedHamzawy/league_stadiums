<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('league_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('league_users', function(Blueprint $table) {
			$table->foreign('league_id')->references('id')->on('leagues')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('league_users', function(Blueprint $table) {
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

        Schema::table('league_users', function(Blueprint $table) {
			$table->dropForeign('league_users_league_id_foreign');
		});
		Schema::table('league_users', function(Blueprint $table) {
			$table->dropForeign('league_users_user_id_foreign');
		});

        Schema::dropIfExists('league_users');
    }
}
