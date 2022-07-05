<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro_pulsera;
use App\Models\Paciente;

class RegistroPulserasController extends Controller
{
    public function vista()
    {
        /*$subquery = Registro_pulsera::where('paciente_id', '=', 1)
        ->where('fecha','=','2021-06-7')->max('pulso_cardiaco');
        
        $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $subquery)
        ->where('paciente_id', '=', 1)
        ->where('fecha','=','2021-06-7')->get();*/

        //$registros = Registro_pulsera::with('paciente')->where('paciente_id','=', 1)->get();

        $registro = Registro_pulsera::where(
            'paciente_id', '=', '1')
            ->where('fecha','=','2021-06-7')->get();
 

        $data_temp = [];

        foreach($registro as $registro_temperatura)
        {
            $data_temp['label_hora'][] = $registro_temperatura->hora;
            $data_temp['data_temperatura'][] = $registro_temperatura->temperatura;
            $data_temp['data_pulso_cardiaco'][] = $registro_temperatura->pulso_cardiaco;
            $data_temp['data_oxi_sangre'][] = $registro_temperatura->oxigeno_sangre;
        }

        $data_temp['data_temp'] = json_encode($data_temp);
        

        return view('desing', $data_temp);

    }
}
