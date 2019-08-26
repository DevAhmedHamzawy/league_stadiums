<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('stadium_id')->unsigned();
            $table->string('name', 191);
            $table->integer('teams_no');
            $table->enum('regulation', array('groups', 'types'));
            $table->enum('selection', array('random', 'selection'));
            $table->integer('groups_no')->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->boolean('teams_asc');
			$table->text('description');
			$table->text('prize');
			$table->string('image', 191);
            $table->timestamps();
        });

        Schema::table('leagues', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});

        Schema::table('leagues', function(Blueprint $table) {
			$table->foreign('stadium_id')->references('id')->on('leagues')
						->onDelete('cascade')
						->onUpdate('restrict');
        });
        
        Schema::table('leagues', function(Blueprint $table) {
			$table->foreign('type_id')->references('id')->on('types')
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
        Schema::table('leagues', function(Blueprint $table) {
			$table->dropForeign('leagues_stadium_id_foreign');
        });
        
        Schema::table('leagues', function(Blueprint $table) {
			$table->dropForeign('leagues_type_id_foreign');
		});

        Schema::dropIfExists('leagues');
    }
}
