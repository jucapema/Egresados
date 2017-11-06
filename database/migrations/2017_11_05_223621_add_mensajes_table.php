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
            $table->increments('id');
            $table->integer('id_usuario')->unsigned(); //fk
            $table->integer('id_notificacion')->unsigned(); //fk
            $table->string('contenido');
            $table->string('title');
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users');//->onDelate();
            $table->foreign('id_notificacion')->references('id')->on('notificaciones');
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
