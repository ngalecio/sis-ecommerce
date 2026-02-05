<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaDetalle extends Model
{
    //
    protected $table = 'consulta_detalles';
    protected $fillable = [
        'consulta_id',
        'nombre_producto',
        'descripcion',
        'cantidad',
        'precio',
        'total',
        'producto_id',
        'unidad_medida',
        'precio_fraccion',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class);
    }
}
