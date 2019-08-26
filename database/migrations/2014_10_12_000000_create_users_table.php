<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id')->unsigned()->nullable();
			$table->string('user_name', 191);
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
            $table->smallInteger('age')->nullable();
            $table->date('birthdate')->nullable();
			$table->integer('mobile')->unique();
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
			$table->decimal('lat', 10,8)->nullable();
            $table->decimal('lon', 11,8)->nullable();
            $table->string('city', 191)->nullable();
			$table->string('qrcode')->nullable();
            $table->string('avatar')->default('avatar.png');
            $table->boolean('active')->default(false);
            $table->string('activation_token');
            $table->string('ref', 32)->unique()->nullable();
            $table->string('password');           
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('users', function(Blueprint $table) {
			$table->foreign('position_id')->references('id')->on('positions')
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
        Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_position_id_foreign');
        });
      
        Schema::dropIfExists('users');
    }
}
