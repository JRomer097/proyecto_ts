<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER crear_id_pulsera
        AFTER INSERT
        ON pacientes
        FOR EACH ROW
        BEGIN
            IF(new.id <= 9)THEN
                INSERT INTO id_generados_pacientes(id_pacientePersonalizada, id_pacienteFk) VALUES(CONCAT("P0000",new.id),new.id);
            ELSEIF(new.id >= 10 AND new.id <= 99)THEN
                INSERT INTO id_generados_pacientes(id_pacientePersonalizada, id_pacienteFk) VALUES(CONCAT("P000",new.id),new.id);
            ELSEIF(new.id >= 100 AND new.id <= 999)THEN
                INSERT INTO id_generados_pacientes(id_pacientePersonalizada, id_pacienteFk) VALUES(CONCAT("P00",new.id),new.id);
            ELSEIF(new.id >= 1000 AND new.id <= 9999)THEN
                INSERT INTO id_generados_pacientes(id_pacientePersonalizada, id_pacienteFk) VALUES(CONCAT("P0",new.id),new.id);
            ELSEIF(new.id >= 10000 AND new.id <= 99999)THEN
                INSERT INTO id_generados_pacientes(id_pacientePersonalizada, id_pacienteFk) VALUES(CONCAT("P",new.id),new.id);
            END IF;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS crear_id_pulsera');
    }
}
