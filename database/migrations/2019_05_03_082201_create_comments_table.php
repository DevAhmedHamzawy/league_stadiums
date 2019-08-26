<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
			$table->integer('match_id')->unsigned()->nullable();
			$table->integer('league_id')->unsigned()->nullable();
			$table->string('name', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('text');
            $table->timestamps();
        });

        Schema::table('comments', function(Blueprint $table) {
			$table->foreign('match_id')->references('id')->on('matches')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('league_id')->references('id')->on('leagues')
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
        Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_match_id_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_league_id_foreign');
		});

        Schema::dropIfExists('comments');
    }
}
