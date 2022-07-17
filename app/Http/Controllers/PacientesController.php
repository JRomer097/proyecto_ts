<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Registro_pulsera;
use Illuminate\Support\Facades\DB;


class PacientesController extends Controller
{
        //Vista de pruebas
        public function vista()
        {
            return view('desing');
        }

        //Mandamos y mostramos la información de la DB
        public function list_paciente()
        {
            $pacientes = Paciente::all();
            return view('list_paciente', [
                'pacientes' => $pacientes
            ]);
        }
    
        //Ventana para graficar la informacion del paciente
        public function graficar(Paciente $paciente)
        {
            //datos de x paciente
            $datos = $paciente;

            //obtenemos la fecha mas actual al hacer la primera grafica de X paciente
            $registro_actual_subquery = Registro_pulsera::where('paciente_id','=',$paciente -> id)
            ->max('fecha');
            //Maximo, Minimo y promedio de la temperatura
            $temperatura_status = Registro_pulsera::selectRaw(
                'MAX(temperatura) AS max_temp, paciente_id, MIN(temperatura) AS min_temp, TRUNCATE(AVG(temperatura), 2) AS avg_temp'
            )
            ->where('fecha', '=', $registro_actual_subquery)->where('paciente_id','=', $paciente -> id)->groupBy('paciente_id')->get();    
            //Maximo, Minimo y promedio de la Frecuencia Cardiaca
            $heart_status = Registro_pulsera::selectRaw(
                'MAX(pulso_cardiaco) AS max_heart, paciente_id, MIN(pulso_cardiaco) AS min_heart, TRUNCATE(AVG(pulso_cardiaco), 2) AS avg_heart'
            )
            ->where('fecha', '=', $registro_actual_subquery)->where('paciente_id','=', $paciente -> id)->groupBy('paciente_id')->get();
            //Maximo, Minimo y promedio del oxigeno en la sangre
            $blood_status = Registro_pulsera::selectRaw(
                'MAX(oxigeno_sangre) AS max_blood, paciente_id, MIN(oxigeno_sangre) AS min_blood, TRUNCATE(AVG(oxigeno_sangre), 2) AS avg_blood'
            )
            ->where('fecha', '=', $registro_actual_subquery)->where('paciente_id','=', $paciente -> id)->groupBy('paciente_id')->get();

            if ($registro_actual_subquery == null) {
                $status = 0;
            }else{
                $status = 1;
            }

            //Registro mas actual del paciente
            $registro_actual = Registro_pulsera::where('paciente_id','=',$paciente -> id)
            -> where('fecha','=', $registro_actual_subquery) -> orderBy('hora', 'DESC')->limit(1)-> get();

            //Consultas para el catalogo de fechas
            $fechas = Registro_pulsera::select('fecha')->where('paciente_id','=',  $paciente -> id)
            -> groupBy('fecha') -> get();

            $fechas_day = Registro_pulsera::selectRaw('fecha, EXTRACT(DAY FROM fecha) as dia')
            ->where('paciente_id','=',  $paciente -> id)
            -> groupBy('fecha') -> get();
            

            $registro = Registro_pulsera::where(
                'paciente_id', '=', $paciente -> id)
                ->where('fecha','=', $registro_actual_subquery) ->orderBy('hora', 'ASC') ->get();
     
    
            $data_temp = [];
    
            foreach($registro as $registro_temperatura)
            {
                $data_temp['label_hora'][] = $registro_temperatura->hora;
                $data_temp['data_temperatura'][] = $registro_temperatura->temperatura;
                $data_temp['data_pulso_cardiaco'][] = $registro_temperatura->pulso_cardiaco;
                $data_temp['data_oxi_sangre'][] = $registro_temperatura->oxigeno_sangre;
            }
    
            $data_temp['data_temp'] = json_encode($data_temp);

            //pasamos estas cosultas a la vista grafica
              return view('grafica', $data_temp, [
                'datos' => $datos,
                'registro_actual' => $registro_actual,
                'fechas_day' => $fechas_day,
                'fechas' => $fechas,
                'temperatura_status' => $temperatura_status,
                'heart_status' => $heart_status,
                'blood_status' => $blood_status,
                'status' => $status
            ]);

        }

        public function graficar_fecha(Request $request, Paciente $paciente)
        {
            //Buscamos si hay registros en la fecha seleccionada
            $registro_actual_subquery = Registro_pulsera::where('paciente_id','=',$paciente -> id)
            -> where('fecha','=', $request -> fecha)->get();
            
            //Maximo, Minimo y promedio de la temperatura
            $temperatura_status = Registro_pulsera::selectRaw(
                'MAX(temperatura) AS max_temp, paciente_id, MIN(temperatura) AS min_temp, TRUNCATE(AVG(temperatura), 2) AS avg_temp'
            )
            ->where('fecha', '=', $request -> fecha)->where('paciente_id','=', $paciente -> id)->groupBy('paciente_id')->get();

            //Maximo, Minimo y promedio de la Frecuencia Cardiaca
            $heart_status = Registro_pulsera::selectRaw(
                'MAX(pulso_cardiaco) AS max_heart, paciente_id, MIN(pulso_cardiaco) AS min_heart, TRUNCATE(AVG(pulso_cardiaco), 2) AS avg_heart'
            )
            ->where('fecha', '=', $request -> fecha)->where('paciente_id','=', $paciente -> id)->groupBy('paciente_id')->get();
            //Maximo, Minimo y promedio del oxigeno en la sangre
            $blood_status = Registro_pulsera::selectRaw(
                'MAX(oxigeno_sangre) AS max_blood, paciente_id, MIN(oxigeno_sangre) AS min_blood, TRUNCATE(AVG(oxigeno_sangre), 2) AS avg_blood'
            )
            ->where('fecha', '=', $request -> fecha)->where('paciente_id','=', $paciente -> id)->groupBy('paciente_id')->get();
            
            if ($registro_actual_subquery == null) {
                $status = 0;
            }else{
                $status = 1;
            }

            //
            $datos = $paciente;
            $registro_actual = Registro_pulsera::where('paciente_id','=', $paciente -> id)
            -> where('fecha','=', $request -> fecha) -> orderBy('hora', 'DESC')->limit(1)-> get();

            //Consultas para las fechas
            $fechas = Registro_pulsera::select('fecha')->where('paciente_id','=',  $paciente -> id)
            -> groupBy('fecha') -> get();

            $fechas_day = Registro_pulsera::selectRaw('fecha, EXTRACT(DAY FROM fecha) as dia')
            ->where('paciente_id','=',  $paciente -> id)
            -> groupBy('fecha') -> get();

            $registro = Registro_pulsera::where(
                'paciente_id', '=', $paciente -> id)
                ->where('fecha','=', $request -> fecha) ->orderBy('hora', 'ASC') ->get();
    
            $data_temp = [];
            foreach($registro as $registro_temperatura)
            {
                $data_temp['label_hora'][] = $registro_temperatura->hora;
                $data_temp['data_temperatura'][] = $registro_temperatura->temperatura;
                $data_temp['data_pulso_cardiaco'][] = $registro_temperatura->pulso_cardiaco;
                $data_temp['data_oxi_sangre'][] = $registro_temperatura->oxigeno_sangre;
            }
            $data_temp['data_temp'] = json_encode($data_temp);
            
            return view('grafica', $data_temp, [
                'datos' => $datos,
                'registro_actual' => $registro_actual,
                'fechas' => $fechas,
                'fechas_day' => $fechas_day,
                'temperatura_status' => $temperatura_status,
                'heart_status' => $heart_status,
                'blood_status' => $blood_status,
                'status' => $status
            ]);
        }
    
        //Ventana para editar los datos del paciente
        public function edit(Paciente $paciente)
        {
            return view('Editar', [
                'paciente' => $paciente
            ]);
        }
    
        //Actualizar la informacion del paciente
        public function update(Request $request, Paciente $paciente)
        {
            $update_paciente = Paciente::find($paciente -> id);
            $update_paciente->nombre = $request -> nombre;
            $update_paciente->apellido_paterno = $request -> apellido_paterno;
            $update_paciente->apellido_materno = $request -> apellido_materno;
            $update_paciente->fecha_nacimiento = $request -> fecha_nacimiento;
            $update_paciente->peso = $request -> peso;
            $update_paciente->altura = $request -> altura;
            $update_paciente->tipo_de_sangre = $request -> tipo_de_sangre;
            //$paciente -> update($request -> all());
            $update_paciente -> save();
            DB::unprepared('CALL calcular_edad()');
            return redirect() -> route('pacientes.list_paciente');
        }
    
        //Guarda la informacion del nuevo paciente
        public function store(Request $request)
        {
            //Validamos los parametros
            $validar = $request -> validate([
                'nombre' => 'required',
                'apellido_paterno' => 'required',
                'apellido_materno' => 'required',
                'fecha_nacimiento' => 'required',
                'peso' =>'required',
                'altura' => 'required',
                'tipo_de_sangre' => 'required|min:2'
                
            ],  ['nombre.required'=>'Necesito un nombre', 
                'apellido_paterno.required'=>'Necesito un apellido paterno',
                'apellido_materno.required'=>'Necesito un apellido materno',
                'fecha_nacimiento.required'=>'Necesito una fecha',
                'peso.required'=>'Necesito un peso',
                'altura.required'=>'Necesito la altura',
                'tipo_de_sangre.required'=>'Necesito el tipo de sangre']
            );
            
            //Guardamos la informción del nuevo paciente al validarlo
            Paciente::create([
                'nombre' => $request -> nombre,
                'apellido_paterno' => $request -> apellido_paterno,
                'apellido_materno' => $request -> apellido_materno,
                'fecha_nacimiento' => $request -> fecha_nacimiento,
                'peso' => $request -> peso,
                'altura' => $request -> altura,
                'tipo_de_sangre' => $request -> tipo_de_sangre
            ]);
            DB::unprepared('CALL calcular_edad()');
            return redirect() -> route('pacientes.paciente');
        }
    
        //Borra la informacion del paciente
        public function destroy(Paciente $paciente)
        {
            $paciente -> delete();
            return back();
        }

        public function index()
        { 
            $id_pacientes = Paciente::select('id', 'nombre')->get();
            $count = count($id_pacientes);
            if ($count < 1) {
                $count = 1;
                $fechas_actuales[0]=[
                    'paciente_id' => 0,
                    'nombre' => "??",
                    'fecha' => "xxxx-xx-xx",
                    'hora' => "xx:xx",
                    'temperatura' => "??",
                    'pulso_cardiaco' => "??",
                    'oxigeno_sangre' => "??"
                ];
                return view('pacientes',[
                    'fechas_actuales' => $fechas_actuales,
                    'count' => $count
                ]);
            }

            $count = 0;
            foreach ($id_pacientes as $id_paciente) {
                $fecha_actual = Registro_pulsera::select('fecha')->where('paciente_id','=', $id_paciente -> id)
                ->max('fecha');
                if ($fecha_actual == null) {
                    $fechas_actuales[$count]=[
                        'paciente_id' => $id_paciente -> id,
                        'fecha' => "??"
                    ];
                }else{
                    $fechas_actuales[$count]=[
                        'paciente_id' => $id_paciente -> id,
                        'fecha' => $fecha_actual
                    ];
                }
                $count = $count + 1;
            }

            for ($i=0; $i < count($fechas_actuales); $i++) {
                if ($fechas_actuales[$i]['fecha'] == "??") {
                    $paciente_nombre = Paciente::select('nombre')->where('id','=', $fechas_actuales[$i]['paciente_id'])->get();
                    foreach ($paciente_nombre as $paciente) {
                        $fechas_actuales[$i]=[
                            'paciente_id' => $fechas_actuales[$i]['paciente_id'],
                            'nombre' => $paciente->nombre,
                            'fecha' => "xxxx-xx-xx",
                            'hora' => "xx:xx",
                            'temperatura' => "??",
                            'pulso_cardiaco' => "??",
                            'oxigeno_sangre' => "??"
                        ];
                    }
                }else{
                    $registro_actual_subquery = Registro_pulsera::where('fecha','=', $fechas_actuales[$i]['fecha'])
                    ->where('paciente_id','=', $fechas_actuales[$i]['paciente_id'])->max('hora');
                    
                    $registro_actual = Registro_pulsera::select('paciente_id','fecha','hora','temperatura',
                    'pulso_cardiaco','oxigeno_sangre', 'pacientes.id', 'pacientes.nombre')
                    ->join('pacientes','pacientes.id','=','registro_pulseras.paciente_id')
                    ->where('hora','=', $registro_actual_subquery)->where('fecha','=', $fechas_actuales[$i]['fecha'])
                    ->where('paciente_id','=', $fechas_actuales[$i]['paciente_id'])->get();
                    foreach($registro_actual as $registro)
                    {
                        $fechas_actuales[$i]=[
                            'paciente_id' => $fechas_actuales[$i]['paciente_id'],
                            'nombre' => $registro -> nombre,
                            'fecha' => $fechas_actuales[$i]['fecha'],
                            'hora' => $registro_actual_subquery,
                            'temperatura' => $registro -> temperatura,
                            'pulso_cardiaco' => $registro -> pulso_cardiaco,
                            'oxigeno_sangre' => $registro -> oxigeno_sangre
                        ];
                    }
                }

            }

            $count = count($fechas_actuales);
            return view('pacientes',[
                'fechas_actuales' => $fechas_actuales,
                'count' => $count
            ]);

            /*SELECT paciente_id, MAX(fecha), MAX(hora), temperatura, pulso_cardiaco, oxigeno_sangre, pacientes.id, pacientes.nombre
            FROM registro_pulseras INNER JOIN pacientes ON registro_pulseras.paciente_id = pacientes.id
            GROUP BY paciente_id;*/
        }
    
    /*public function show(){
        return redirect() -> route('pacientes.list_paciente');
    }*/
}
