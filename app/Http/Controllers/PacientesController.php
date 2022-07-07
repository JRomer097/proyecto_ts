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

            //consulta para obtener datos del paciente X en la hora y fecha mas actual registrada
            /*$registro_pulsera_subquery = Registro_pulsera::where('paciente_id', '=', $pacientes -> id)
            ->where('fecha','=', $registro_actual_subquery)->max('pulso_cardiaco');
            $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $registro_pulsera_subquery)
            ->where('paciente_id', '=', $pacientes -> id)
            ->where('fecha','=', $registro_actual_subquery)->limit(1)->get();*/
            /*$registro_pulsera = Registro_pulsera::where('paciente_id', '=', $pacientes -> id)
            ->where('fecha','=', $registro_actual_subquery)->limit(1)->get();*/

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
            //consulta para obtener datos de x fecha de x paciente
            /*$subquery = Registro_pulsera::where('paciente_id', '=', $pacientes -> id)
            ->where('fecha','=', $request -> fecha)->max('pulso_cardiaco');

            $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $subquery)
            ->where('paciente_id', '=', $pacientes -> id)
            ->where('fecha','=', $request -> fecha)->limit(1)->get();*/
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
            
            $fechas_actuales[0]['edad']= 0;
            $fechas_actuales[0]['peso']= 1;
            $fechas_actuales[1]['edad']= 0;
            $fechas_actuales[1]['peso']= 1;
            
            return view('pacientes', [
                'fechas_actuales' => $fechas_actuales 
            ]);

            //return($fechas_actuales);

            //return($fechas_actual);
            /*foreach($id_pacientes as $paciente)
            {
                $fechas_actual = Registro_pulsera::select('fecha')->where('paciente_id','=', $paciente->id )
                ->groupBy('fecha')->orderBy('fecha', 'DESC')->limit(1)->get();
                foreach($fechas_actual as $fecha_act){
                    $fechas_actuales[$cont]=[
                        'fecha'=>$fecha_act->fecha,
                        'paciente_id'=>$paciente->id
                    ];
                    $cont = $cont + 1;
                }
            }*/

            //return view('pacientes', compact('fechas_actuales'));
            //$object_fechas_actuales = json_decode(json_encode($fechas_actuales), FALSE);
            //$fechas_actuales['fechas_actuales'] = json_encode($fechas_actuales);
            //$object = json_encode($id_pacientes);
       
            /*$registros_actuales=[];
            $cont = 0;
            foreach($object_fechas_actuales as $fecha)
            {
                $registro_actual_subquery = Registro_pulsera::where('fecha','=', $fecha->fecha)
                ->where('paciente_id','=',$fecha->paciente_id)->max('hora');

                $registro_actual = Registro_pulsera::where('paciente_id','=', $fecha->paciente_id )
                ->where('fecha','=', $fecha -> fecha)->where('hora', '=', $registro_actual_subquery)->get();
                foreach($registro_actual as $algo){
                    $registros_actuales[$cont]['id'] = $algo -> id;
                    $registros_actuales[$cont]['paciente_id'] = $algo->paciente_id;
                    $registros_actuales[$cont]['id_pulsera'] = $algo -> id_pulsera;
                    $registros_actuales[$cont]['fecha'] = $algo->fecha;
                    $registros_actuales[$cont]['hora'] = $algo -> hora;
                    $registros_actuales[$cont]['temperatura'] = $algo->temperatura;
                    $registros_actuales[$cont]['pulso_cardiaco'] = $algo->pulso_cardiaco;
                    $registros_actuales[$cont]['oxigeno_sangre'] = $algo->oxigeno_sangre;
                    $cont = $cont + 1;
                }
            }
            $object_registros_actuales = json_decode(json_encode($registros_actuales), FALSE);*/

            /*$registros_actuales=[];
            $cont = 0;
            foreach($object_fechas_actuales as $fecha)
            {
                $registro_actual_subquery = Registro_pulsera::where('fecha','=', $fecha->fecha)
                ->where('paciente_id','=',$fecha->paciente_id)->max('hora');

                $registro_actual = Registro_pulsera::select('paciente_id','fecha','hora','temperatura',
                'pulso_cardiaco','oxigeno_sangre', 'pacientes.id', 'pacientes.nombre')
                ->join('pacientes','pacientes.id','=','registro_pulseras.paciente_id')
                ->where('hora','=', $registro_actual_subquery)->where('fecha','=', $fecha -> fecha)
                ->where('paciente_id','=', $fecha->paciente_id )->get();

                /*$registro_actual = Registro_pulsera::where('paciente_id','=', $fecha->paciente_id )
                ->where('fecha','=', $fecha -> fecha)->where('hora', '=', $registro_actual_subquery)->get();

                foreach($registro_actual as $algo){
                    $registros_actuales[$cont]['paciente_id'] = $algo -> paciente_id;
                    $registros_actuales[$cont]['fecha'] = $algo->fecha;
                    $registros_actuales[$cont]['hora'] = $algo -> hora;
                    $registros_actuales[$cont]['temperatura'] = $algo->temperatura;
                    $registros_actuales[$cont]['pulso_cardiaco'] = $algo -> pulso_cardiaco;
                    $registros_actuales[$cont]['oxigeno_sangre'] = $algo->oxigeno_sangre;
                    $registros_actuales[$cont]['nombre'] = $algo->nombre;
                    $cont = $cont + 1;
                }
            }
            
            $object_registros_actuales = json_decode(json_encode($registros_actuales), FALSE);*/

            /*$inner = Registro_pulsera::select('paciente_id','fecha','hora','temperatura',
            'pulso_cardiaco','oxigeno_sangre', 'pacientes.id', 'pacientes.nombre')
            ->join('pacientes','pacientes.id','=','registro_pulseras.paciente_id')
            ->where('hora','=','07:54')->where('fecha','=','2022-07-06')
            ->where('paciente_id','=', 1)->get();*/
            //dd($object_registros_actuales);
            /*return view('pacientes', [
                'object_registros_actuales' => $object_registros_actuales
            ]);*/
 
        }
    
}
