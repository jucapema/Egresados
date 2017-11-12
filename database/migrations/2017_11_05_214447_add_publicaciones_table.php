<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->increments('id')->unique(); //pk
            $table->integer('id_administrador')->unsigned(); //fk
            $table->string('titulo');
            $table->string('cuerpo');
            //$table->string('multimedia'); //llave foreana
            $table->foreign('id_administrador')->references('id')->on('administradores');
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
        Schema::dropIfExists('publicaciones');
    }
}
