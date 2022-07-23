<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Paciente::factory(8)->create();
        \App\Models\Registro_pulsera::factory(400)->create();

        \App\Models\Rol::create([
            'nombre_rol'      =>  'Super Administrador'
        ]);
        \App\Models\Rol::create([
            'nombre_rol'      =>  'Administrador'
        ]);
        \App\Models\Rol::create([
            'nombre_rol'      =>  'Doctor'
        ]);

        \App\Models\User::create([
            'name'      =>  'Jose Miguel',
            'rol_id'    =>  1,
            'apellido_paterno' => 'Cruz',
            'apellido_materno' => 'Romero',
            'email'     =>  'jose@gmail.com',
            'password'  =>  bcrypt('123456')
        ]);
        
        \App\Models\User::create([
            'name'      =>  'Felipe',
            'rol_id'    =>  2,
            'apellido_paterno' => 'Loeza',
            'apellido_materno' => 'Aragón',
            'email'     =>  'felipe@gmail.com',
            'password'  =>  bcrypt('123456')

        ]);

        \App\Models\User::create([
            'name'      =>  'Juan',
            'rol_id'    =>  3,
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Jimenez',
            'email'     =>  'juan@gmail.com',
            'password'  =>  bcrypt('123456')
        ]);


    }
}
