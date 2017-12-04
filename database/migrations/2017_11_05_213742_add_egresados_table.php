<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEgresadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->string('intereses')->nullable();
            $table->date('fecha_nacimiento');
            $table->enum('genero',['Masculino','Femenino'])->nullable();
            $table->string('baja')->default('false')->nullable();
            $table->integer('contactos')->unsigned()->nullable();
            $table->integer('favoritos')->unsigned()->nullable();
            $table->string('carrera')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('egresados');
    }
}
