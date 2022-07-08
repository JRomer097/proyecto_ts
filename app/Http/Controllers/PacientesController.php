<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Registro_pulsera;
use DB;


class PacientesController extends Controller
{
        //Vista de pruebas
        public function vista()
        {
            return view('desing');
        }

        //Mandamos y mostramos la información de la DB
        public function paciente()
        {
            $pacientes = Paciente::all();
            return view('add_pacientes', [
                'pacientes' => $pacientes
            ]);
        }
    
        //Ventana para graficar la informacion del paciente
        public function graficar(Paciente $pacientes)
        {
            //datos de x paciente
            $datos = $pacientes;

            //obtenemos la fecha mas actual al hacer la primera grafica de X paciente
            $registro_actual_subquery = Registro_pulsera::where('paciente_id','=',$pacientes -> id)
            ->max('fecha');
            //Registro mas actual del paciente
            $registro_actual = Registro_pulsera::where('paciente_id','=',$pacientes -> id)
            -> where('fecha','=',$registro_actual_subquery) -> orderBy('hora', 'DESC')->limit(1)-> get();

            //Consultas para el catalogo de fechas
            $fechas = Registro_pulsera::select('fecha')->where('paciente_id','=',  $pacientes -> id)
            -> groupBy('fecha') -> get();


            $registro = Registro_pulsera::where(
                'paciente_id', '=', $pacientes -> id)
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
                'fechas' => $fechas
            ]);
        }

        public function graficar_fecha(Request $request, Paciente $pacientes)
        {
            $datos = $pacientes;
            $registro_actual = Registro_pulsera::where('paciente_id','=',$pacientes -> id)
            -> where('fecha','=',$request -> fecha) -> orderBy('hora', 'DESC')->limit(1)-> get();

            //Consultas para las fechas
            $fechas = Registro_pulsera::select('fecha')->where('paciente_id','=',  $pacientes -> id)
            -> groupBy('fecha') -> get();

            $registro = Registro_pulsera::where(
                'paciente_id', '=', $pacientes -> id)
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

            //dd($registro_pulsera);
            return view('grafica', $data_temp, [
                'datos' => $datos,
                'registro_actual' => $registro_actual,
                'fechas' => $fechas
            ]);
        }
    
        //Ventana para editar los datos del paciente
        public function editar($pacientes)
        {
            $datos = Paciente::find($pacientes);
            return view('Editar', [
                'datos' => $datos
            ]);
        }
    
        //Actualizar la informacion del paciente
        public function update(Request $request, $pacientes)
        {
            $paciente = Paciente::find($pacientes);
            $paciente->nombre = $request ->nombre;
            $paciente->apellido_paterno = $request ->apellido_paterno;
            $paciente->apellido_materno = $request ->apellido_materno;
            $paciente->edad = $request ->edad;
            $paciente->peso = $request ->peso;
            $paciente->altura = $request ->altura;
            $paciente->tipo_de_sangre = $request ->tipo_de_sangre;
            $paciente -> save();
            return redirect() -> route('pacientes.paciente');
        }
    
        //Guarda la informacion del nuevo paciente
        public function store(Request $request)
        {
            //Validamos los parametros
            $validar = $request -> validate([
                'nombre' => 'required',
                'apellido_paterno' => 'required',
                'apellido_materno' => 'required',
                'edad' => 'required|numeric|min:3',
                'peso' =>'required',
                'altura' => 'required',
                'tipo_de_sangre' => 'required|min:2'
                
            ],  ['nombre.required'=>'Necesito un nombre', 
                'apellido_paterno.required'=>'Necesito un apellido paterno',
                'apellido_materno.required'=>'Necesito un apellido materno',
                'edad.required'=>'Necesito una edad',
                'peso.required'=>'Necesito un peso',
                'altura.required'=>'Necesito la altura',
                'tipo_de_sangre.required'=>'Necesito el tipo de sangre']
            );
    
            //Guardamos la informción del nuevo paciente al validarlo
            Paciente::create([
                'nombre' => $request -> nombre,
                'apellido_paterno' => $request -> apellido_paterno,
                'apellido_materno' => $request -> apellido_materno,
                'edad' => $request -> edad,
                'peso' => $request -> peso,
                'altura' => $request -> altura,
                'tipo_de_sangre' => $request -> tipo_de_sangre
            ]);
            //$update_id_paciente = DB::select('CALL actualizar_id_pacientePersonalizado()');
            return back();
        }
    
        //Borra la informacion del paciente
        public function delete(Paciente $pacientes)
        {
            $pacientes ->delete();
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
                    'nombre' => "no hay",
                    'fecha' => "xxxx-xx-xx",
                    'hora' => "xx:xx",
                    'temperatura' => "sin registro",
                    'pulso_cardiaco' => "sin registro",
                    'oxigeno_sangre' => "sin registro"
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
                        'fecha' => "sin registro"
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
                if ($fechas_actuales[$i]['fecha'] == "sin registro") {
                    $paciente_nombre = Paciente::select('nombre')->where('id','=', $fechas_actuales[$i]['paciente_id'])->get();
                    foreach ($paciente_nombre as $paciente) {
                        $fechas_actuales[$i]=[
                            'paciente_id' => $fechas_actuales[$i]['paciente_id'],
                            'nombre' => $paciente->nombre,
                            'fecha' => "xxxx-xx-xx",
                            'hora' => "xx:xx",
                            'temperatura' => "sin registro",
                            'pulso_cardiaco' => "sin registro",
                            'oxigeno_sangre' => "sin registro"
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
    
}
