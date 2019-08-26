<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
			$table->string('user_name', 191);
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
            $table->smallInteger('age')->nullable();
            $table->date('birthdate')->nullable();
			$table->integer('mobile')->unique();
			$table->string('email', 191)->unique();
            $table->string('city', 191)->nullable();
			$table->string('qrcode')->nullable();
            $table->string('avatar')->default('avatar.png');
            $table->string('password');           
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
