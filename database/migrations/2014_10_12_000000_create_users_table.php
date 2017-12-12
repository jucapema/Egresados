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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique(); //representara el dni
            $table->string('dni')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('apellido');
            $table->enum('tipo_rol',['root','admin','egresado']);
            $table->enum('estado_cuenta',['activa','ban','suscrita']);
            //$table->string('pais');
          //  $table->dateTime('last_login')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
