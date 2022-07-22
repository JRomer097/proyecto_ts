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
        \App\Models\Registro_pulsera::factory(250)->create();
        \App\Models\User::create([
            'name'      =>  'Jose Romero',
            'email'     =>  'jose@gmail.com',
            'password'  =>  bcrypt('123456')
        ]);

        \App\Models\User::create([
            'name'      =>  'Felipe',
            'email'     =>  'felipe@gmail.com',
            'password'  =>  bcrypt('123456')
        ]);

        \App\Models\User::create([
            'name'      =>  'Juan',
            'email'     =>  'juan@gmail.com',
            'password'  =>  bcrypt('123456')
        ]);

        \App\Models\Rol::create([
            'nombre_rol'      =>  'Super Administrador'
        ]);
        \App\Models\Rol::create([
            'nombre_rol'      =>  'Administrador'
        ]);
        \App\Models\Rol::create([
            'nombre_rol'      =>  'Doctor'
        ]);

        \App\Models\RolUser::create([
            'rol_id'      =>  1,
            'user_id'      =>  1
        ]);
        \App\Models\RolUser::create([
            'rol_id'      =>  2,
            'user_id'      =>  2
        ]);
        \App\Models\RolUser::create([
            'rol_id'      =>  3,
            'user_id'      =>  3
        ]);
    }
}
