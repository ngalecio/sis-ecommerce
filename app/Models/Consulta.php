<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    //
    protected $table = 'consultas';
     
    protected $fillable = [
        'fecha',
        'paciente_id',
        'tipo_consulta',
        'comentario_1',
        'comentario_2',
        'comentario_3',
        'comentario_4',
        'establecimiento',
        'alergias',
        'medicamentos',
        'antecedentes_personales',
        'antecedentes_familiares',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function imagenes()
    {
        return $this->hasMany(ConsultaImagen::class);
    }

    public function detalles()
    {
        return $this->hasMany(ConsultaDetalle::class);
    }
}
