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
        }
    
        //Ventana para graficar la informacion del paciente
        public function graficar(Paciente $pacientes)
        {
            $subquery = Registro_pulsera::where('id_paciente', '=', $pacientes -> id)
            ->where('fecha','=','2021-06-7')->max('pulso_cardiaco');
            
            $registro_pulsera = Registro_pulsera::where('pulso_cardiaco', '=', $subquery)
            ->where('id_paciente', '=', $pacientes -> id)
            ->where('fecha','=','2021-06-7')->limit(1)->get();

            $datos = $pacientes;

            return view('grafica', [
                'datos' => $datos,
                'registro_pulsera' => $registro_pulsera
            ]);

            //dd($registro_pulsera);
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
            return redirect() -> route('pacientes.index');
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
    
}
