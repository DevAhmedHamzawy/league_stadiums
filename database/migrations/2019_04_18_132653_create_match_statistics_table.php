<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unsigned();
			$table->integer('goals_t1')->nullable();
			$table->integer('goals_t2')->nullable();
			$table->integer('yellowcards_t1')->nullable();
			$table->integer('yellowcards_t2')->nullable();
			$table->integer('redcards_t1')->nullable();
			$table->integer('redcards_t2')->nullable();
			$table->integer('penalties_t1')->nullable();
			$table->integer('penalties_t2')->nullable();
            $table->timestamps();
        });

        Schema::table('match_statistics', function(Blueprint $table) {
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
        Schema::table('match_statistics', function(Blueprint $table) {
			$table->dropForeign('match_statistics_match_id_foreign');
		});

        Schema::dropIfExists('match_statistics');
    }
}
