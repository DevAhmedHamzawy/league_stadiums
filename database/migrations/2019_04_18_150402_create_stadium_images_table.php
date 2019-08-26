<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStadiumImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadium_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stadium_id')->unsigned();
			$table->string('text');
            $table->boolean('main');
            $table->text('file');
            $table->timestamps();
        });

        Schema::table('stadium_images', function(Blueprint $table) {
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
        Schema::table('stadium_images', function(Blueprint $table) {
			$table->dropForeign('stadium_images_stadium_id_foreign');
		});

        Schema::dropIfExists('stadium_images');
    }
}
