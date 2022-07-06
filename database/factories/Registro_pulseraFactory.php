<?php

namespace Database\Factories;

use App\Models\Registro_pulsera;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Str;

class Registro_pulseraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $decimal = $this->faker->numberBetween(0,99);
        $pul = rand(1,8);
        $id_pul = "P00$pul";
        return [
            //'paciente_id' =>rand(1,8),
            'paciente_id' => $pul,
            'id_pulsera' => $id_pul,
            //'id_pulsera' => $this->faker->randomElement(['P001','P002','P003','P004','P005','P006','P007','P008']),
            'fecha' => $this->faker->dateTimeBetween('-3 days', 'now'),
            'hora' => $this->faker->time('H:i'),
            'temperatura' => $this->faker->numberBetween(35,39)+$decimal/10,
            'pulso_cardiaco' => $this->faker->numberBetween(60,120),
            'oxigeno_sangre' => $this->faker->numberBetween(90,100)
        ];
    }
}
