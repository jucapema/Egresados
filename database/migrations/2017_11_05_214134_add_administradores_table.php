<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdministradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            //$table->integer('id_publicaciones')->unsigned();
            $table->string('direccion');
            $table->string('ciudad');
            $table->integer('telefono')->unsigned();
          //  $table->foreign('id_publicaciones')->references('id')->on('publicaciones');
            $table->foreign('id_usuario')->references('id')->on('users');
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
        Schema::dropIfExists('administradores');
    }
}
