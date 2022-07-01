<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('id_paciente')->nullable()->unique();
            $table->string('nombre_p', 50);
            $table->string('apellidoP_p', 50);
            $table->string('apellidoM_p', 50);
            $table->integer('edad');
            $table->double('peso', 3);
            $table->double('altura', 1);
            $table->string('tipo_de_sangre', 50);
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
        Schema::dropIfExists('pacientes');
    }
}
