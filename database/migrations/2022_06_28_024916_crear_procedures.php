<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS actualizar_id_pacientePersonalizado;
                        DROP PROCEDURE IF EXISTS llenar_hora;');
        DB::unprepared('CREATE PROCEDURE llenar_hora()  
        BEGIN
    DECLARE minuto_t VARCHAR(10);
    DECLARE hora_t VARCHAR(10);
    DECLARE contador INT(10);
    DECLARE id2 INT(10);
    DECLARE hora_cont INT(10);
    DECLARE minuto_cont INT(10);
    DECLARE tiempo VARCHAR(10);
    SET contador = 1;
    SET hora_cont = 0;
    SET minuto_cont = 0;
    SET id2 = 1;
    WHILE (contador <= 61 ) DO
        WHILE (hora_cont <= 23 ) DO
            IF hora_cont <= 9 THEN
                SET hora_t = CONCAT("0",hora_cont);
            ELSE
                SET hora_t = hora_cont;
            END IF;
            WHILE (minuto_cont <= 50 ) DO
                IF minuto_cont = 0 THEN
                    SET minuto_t = CONCAT("0", minuto_cont);
                    SET tiempo = CONCAT(hora_t,":",minuto_t);
                    UPDATE registro_pulseras SET hora = tiempo WHERE id = id2;
                ELSE
                    SET tiempo = CONCAT(hora_t,":",minuto_cont);
                    UPDATE registro_pulseras SET hora = tiempo WHERE id = id2;
                END IF;
                SET id2 = id2 + 1;
                SET minuto_cont = minuto_cont + 10;
            END WHILE;
            SET minuto_cont = 0;
            SET hora_cont = hora_cont + 1;
        END WHILE;
            SET hora_cont = 0;
            SET contador = contador + 1;
    END WHILE;
END');
        DB::unprepared('CREATE PROCEDURE actualizar_id_pacientePersonalizado(
            )
            BEGIN
              DECLARE contador_inicio INT(10);
              DECLARE contador_c INT(10);
              DECLARE id_personalizada VARCHAR(50);
              DECLARE id_pacienteRegistro VARCHAR(50);
              DECLARE id_registro INT(10);
              DECLARE id_nada VARCHAR(50);
              SELECT COUNT(id) FROM pacientes WHERE id_pacientePersonalizada IS NULL INTO contador_inicio;
              SET contador_c = 0;
                IF (contador_inicio > 0 ) THEN
                  WHILE (contador_c <= contador_inicio) DO
                    SELECT id, id_pacientePersonalizada FROM pacientes WHERE id_pacientePersonalizada IS NULL LIMIT 1 INTO id_registro, id_pacienteRegistro;
                    SET id_personalizada = (SELECT id_pacientePersonalizada FROM id_generados_pacientes WHERE id_paciente = id_registro);
                    UPDATE pacientes SET id_pacientePersonalizada = id_personalizada WHERE id = id_registro;
                    SET contador_c = contador_c + 1;
                  END WHILE;
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
    }
}
