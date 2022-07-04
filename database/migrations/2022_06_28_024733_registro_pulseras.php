<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroPulseras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_pulseras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_paciente')->unsigned();
            $table->string('id_pulsera');
            $table->date('fecha');
            $table->string('hora')->nullable();
            $table->double('temperatura');
            $table->integer('pulso_cardiaco');
            $table->integer('oxigeno_sangre');
            $table->timestamps();
            $table->foreign('id_paciente')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_pulseras');
    }
}
