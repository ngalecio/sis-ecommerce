<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaImagen extends Model
{
    //
    protected $fillable = [
        'consulta_id',
        'imagen',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
