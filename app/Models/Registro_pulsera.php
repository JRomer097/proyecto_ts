<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_pulsera extends Model
{
    use HasFactory;

    public function paciente()
    {
        return $this-> beLongsTo(Paciente::class);
    }
}
