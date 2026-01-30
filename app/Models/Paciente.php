<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $table = 'pacientes';
    protected $fillable = [
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'celular',
        'cedula',
        'ruc',
        'email',
        'estado',
        'es_cliente',
        'es_proveedor',
        'tipo_identificacion',
        'tipo_persona',
        'credito_usado',
        'credito_saldo',
        'cupo_credito',
        'tipo_contribuyente',
        'fecha_nacimiento',
        'medicamentos',
        'antecedentes_personales',
        'alergias',
        'antecedentes_familiares',
        'establecimiento',
    ];

    public function catalogo_tipo_persona()
    {
        return $this->belongsTo(CatalogoDetalle::class, 'tipo_persona', 'codigo_catalogo_detalle')
        ->where('codigo_catalogo', 'TIPO_PERSONA');
    }

    public function catalogo_tipo_identificacion()
    {
        return $this->belongsTo(CatalogoDetalle::class, 'tipo_identificacion', 'codigo_catalogo_detalle')
            ->where('codigo_catalogo', 'TIPO_IDENTIFICACION');
    }
}
