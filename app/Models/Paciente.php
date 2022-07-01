<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_p',
        'apellidoP_p',
        'apellidoM_p',
        'edad',
        'peso',
        'altura',
        'tipo_de_sangre'
    ];

    public function registro()
    {
        return $this-> hasMany(Registro_pulsera::class);
    }
}
