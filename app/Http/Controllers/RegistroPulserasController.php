<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro_pulsera;

class RegistroPulserasController extends Controller
{
    public function vista()
    {
        /*$subquery = Registro_pulsera::where('id_pacientePersonalizada', '=', 'P00001')
        ->where('fecha','=','2021-06-7')->max('pulso_cardiaco');
        
        $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $subquery)
        ->where('id_pacientePersonalizada', '=', 'P00001')
        ->where('fecha','=','2021-06-7')->get();*/

        $registro_pulsera = Registro_pulsera::where(
            'id_pacientePersonalizada', '=', 'P00001')
            ->where('fecha','=','2021-06-7')->get();

        $data = [];
        foreach($registro_pulsera as $registro)
        {
            $data['label'][] = $registro->hora;
            $data['data'][] = $registro->temperatura;
        }
        $data['data'] = json_encode($data);

        return view('desing', $data);         
        //dd($data);  

    }
}
