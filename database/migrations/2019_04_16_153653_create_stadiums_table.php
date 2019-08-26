<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStadiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadiums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->decimal('rent_by_hour')->nullable();
            $table->decimal('rent_by_league')->nullable();
            $table->string('ratings')->nullable();
            $table->bigInteger('telephone');
            $table->text('address');
            $table->string('city');
            $table->decimal('lat', 10,8);
            $table->decimal('lon', 11,8);
            $table->timestamps();

        });

        Schema::table('stadiums', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
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
        Schema::table('stadiums', function(Blueprint $table) {
			$table->dropForeign('stadiums_user_id_foreign');
        });

        Schema::dropIfExists('stadiums');
    }
}
