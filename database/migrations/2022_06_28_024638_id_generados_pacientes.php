<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdGeneradosPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('id_generados_pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('id_pacientePersonalizada');
            //$table->foreign('id_pacientePersonalizadaF')->references('id')->on('users');
            $table->string('id_pacienteFk');
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
        Schema::dropIfExists('id_generados_pacientes');
    }
}
