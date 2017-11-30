<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_egresado')->unsigned(); //fk
            $table->integer('send_id')->unsigned();
            //$table->integer('id_notificacion')->unsigned(); //fk
            $table->string('contenido');
            $table->string('title');
            $table->timestamps();
            $table->foreign('id_egresado')->references('id')->on('egresados');//->onDelate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}
