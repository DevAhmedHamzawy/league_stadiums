<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('conditions');
			$table->text('about');
			$table->string('facebook');
			$table->string('youtube');
			$table->string('instagram');
			$table->string('twitter');
			$table->string('snapchat');
			$table->decimal('lat', 10,8);
			$table->decimal('lon', 11,8);
			$table->bigInteger('telephone1');
			$table->bigInteger('telephone2');
			$table->string('email1');
			$table->string('email2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
