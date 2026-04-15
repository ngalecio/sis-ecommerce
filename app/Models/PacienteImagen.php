<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacienteImagen extends Model
{
    //
    protected $fillable = [
        'paciente_id',
        'imagen',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
