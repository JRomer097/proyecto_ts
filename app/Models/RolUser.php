<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rol_id',
        'user_id'
    ];

    public function rol()
    {
        return $this-> beLongsTo(Rol::class);
    }

    public function users()
    {
        return $this-> beLongsTo(User::class);
    }
}
