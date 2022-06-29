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
            $table->id();
            $table->string('id_pacientePersonalizada');
            $table->string('id_pulsera');
            $table->string('fecha');
            $table->string('hora')->nullable();
            $table->double('temperatura');
            $table->integer('pulso_cardiaco');
            $table->integer('oxi_sangre');
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
        Schema::dropIfExists('registro_pulseras');
    }
}
