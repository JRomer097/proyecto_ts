<?php

namespace Database\Factories;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Str;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'apellido_paterno' => $this->faker->firstName(),
            'apellido_materno' => $this->faker->lastName(),
            'edad' => $this->faker->numberBetween(18,60),
            'peso' => $this->faker->numberBetween(500,1200)/10,
            'altura'=> $this->faker->numberBetween(15, 19)/10, 
            'tipo_de_sangre' => $this->faker->randomElement(['A+','A-','O+','O-'])
        ];
    }
}
