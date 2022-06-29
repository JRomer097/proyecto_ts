<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Registro_pulsera;
use DB;

class PacientesController extends Controller
{
        public function vista()
        {
            return view('desing');
        }

        //Mandamos y mostramos la información de la DB
        public function index()
        {
            $pacientes = Paciente::all();
            return view('add_pacientes', [
                'pacientes' => $pacientes
            ]);
            //return view('welcome');
        }
    
        //Ventana para graficar la informacion del paciente
        public function graficar(Paciente $pacientes)
        {
            $datos = $pacientes;

            $subquery = Registro_pulsera::where('id_pacientePersonalizada', '=', $datos->id_pacientePersonalizada)
            ->where('fecha','=','2021-06-7')->max('pulso_cardiaco') ;
            
            //$subquery = Registro_pulsera::whereRaw('pulso_cardiaco = (SELECT MAX(pulso_cardiaco) FROM registro_pulseras)');
            $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $subquery)
            ->where('id_pacientePersonalizada', '=', $datos->id_pacientePersonalizada)
            ->where('fecha','=','2021-06-7')->get();
                    //return view('grafica', ['datos' => $datos]);
            /*  SELECT * FROM registro_pulseras 
                WHERE pulso_cardiaco = (SELECT MAX(pulso_cardiaco) FROM registro_pulseras 
                WHERE id_pacientePersonalizada = 'P00001'
                AND fecha = '2021-06-7')
                AND id_pacientePersonalizada = 'P00001' AND fecha = '2021-06-7'; */
            //dd($registro_pulsera->toArray());    
            //dd($subquery->toJson());
            //return $subquery;
            //dd($datos->id_pacientePersonalizada);
            return view('grafica', [
                'datos' => $datos,
                'registro_pulsera'=>$registro_pulsera
            ]);
        }
    
        //Ventana para editar los datos del paciente
        public function editar($pacientes)
        {
            $datos = Paciente::find($pacientes);
            return view('Editar', ['datos' => $datos]);
        }
    
        //Actualizar la informacion del paciente
        public function update(Request $request, $pacientes)
        {
            $paciente = Paciente::find($pacientes);
            $paciente->nombre_p = $request ->nombre_p;
            $paciente->apellidoP_p = $request ->apellidoP_p;
            $paciente->apellidoM_p = $request ->apellidoM_p;
            $paciente->edad = $request ->edad;
            $paciente->peso = $request ->peso;
            $paciente->altura = $request ->altura;
            $paciente->tipo_de_sangre = $request ->tipo_de_sangre;
            $paciente -> save();
            return redirect() -> route('pacientes.index');
        }
    
        //Guarda la informacion del nuevo paciente
        public function store(Request $request)
        {
            //Validamos los parametros
            $validar = $request -> validate([
                'nombre_p' => 'required',
                'apellidoP_p' => 'required',
                'apellidoM_p' => 'required',
                'edad' => 'required|numeric|min:3',
                'peso' =>'required',
                'altura' => 'required',
                'tipo_de_sangre' => 'required|min:2'
                
            ],  ['nombre_p.required'=>'Necesito un nombre', 
                'apellidoP_p.required'=>'Necesito un apellido paterno',
                'apellidoM_p.required'=>'Necesito un apellido materno',
                'edad.required'=>'Necesito una edad',
                'peso.required'=>'Necesito un peso',
                'altura.required'=>'Necesito la altura',
                'tipo_de_sangre.required'=>'Necesito el tipo de sangre']
            );
    
            //Guardamos la informción del nuevo paciente al validarlo
            Paciente::create([
                'nombre_p' => $request -> nombre_p,
                'apellidoP_p' => $request -> apellidoP_p,
                'apellidoM_p' => $request -> apellidoM_p,
                'edad' => $request -> edad,
                'peso' => $request -> peso,
                'altura' => $request -> altura,
                'tipo_de_sangre' => $request -> tipo_de_sangre
            ]);
            $update_id_paciente = DB::select('CALL actualizar_id_pacientePersonalizado()');
            return back();
        }
    
        //Borra la informacion del paciente
        public function delete(Paciente $pacientes)
        {
            $pacientes ->delete();
            return back();
        }
    
}
