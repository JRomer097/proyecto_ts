<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro_pulsera;
use App\Models\Paciente;

class RegistroPulserasController extends Controller
{
    public function vista()
    {
        /*$subquery = Registro_pulsera::where('id_pacientePersonalizada', '=', 'P00001')
        ->where('fecha','=','2021-06-7')->max('pulso_cardiaco');
        
        $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $subquery)
        ->where('id_pacientePersonalizada', '=', 'P00001')
        ->where('fecha','=','2021-06-7')->get();*/

        //
        $registros = Registro_pulsera::with('paciente')->where('paciente_id','=', 1)->get();

        /*$registro = Registro_pulsera::where(
            'id_paciente', '=', '1')
            ->where('fecha','=','2021-06-7')->get();
 

        $data_temp = [];
        $data_car = [];
        $data_oxi = [];

        foreach($registro as $registro_temperatura)
        {
            $data_temp['label_hora'][] = $registro_temperatura->hora;
            $data_temp['data_temperatura'][] = $registro_temperatura->temperatura;
        }

        $data_temp['data_temp'] = json_encode($data_temp);
        
        foreach($registro as $registro_cardiaco)
        {
            $data_car['label_hora'][] = $registro_cardiaco->hora;
            $data_car['data_pulso_cardiaco'][] = $registro_cardiaco->pulso_cardiaco;
        }

        $data_car['data_car'] = json_encode($data_car);

        foreach($registro as $registro_oxigeno)
        {
            $data_oxi['label_hora'][] = $registro_oxigeno->hora;
            $data_oxi['data_oxi_sangre'][] = $registro_oxigeno->oxi_sangre;
        }

        $data_oxi['data_oxi'] = json_encode($data_oxi);

        return view('desing', $data_temp, $data_car, $data_oxi);*/  

        return($registros);

    }
}
