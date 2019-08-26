<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('group_id')->unsigned();
			$table->integer('played')->default(0);
			$table->integer('won')->default(0);
			$table->integer('drawn')->default(0);
			$table->integer('lost')->default(0);
			$table->integer('gf')->default(0);
			$table->integer('ga')->default(0);
			$table->integer('gd')->default(0);
			$table->integer('pts')->default(0);
            $table->timestamps();
        });

        Schema::table('league_groups', function(Blueprint $table) {
			$table->foreign('league_id')->references('id')->on('leagues')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('league_groups', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('league_groups', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
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
        Schema::table('league_groups', function(Blueprint $table) {
			$table->dropForeign('league_groups_league_id_foreign');
		});
		Schema::table('league_groups', function(Blueprint $table) {
			$table->dropForeign('league_groups_user_id_foreign');
		});
		Schema::table('league_groups', function(Blueprint $table) {
			$table->dropForeign('league_groups_group_id_foreign');
		});

        Schema::dropIfExists('league_groups');
    }
}
