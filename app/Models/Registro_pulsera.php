<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_pulsera extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_paciente',
        'id_pulsera',
        'fecha',
        'hora',
        'temperatura',
        'pulso_cardiaco',
        'oxigeno_sangre'
    ];

    public function paciente()
    {
        return $this-> beLongsTo(Paciente::class);
    }
}
