<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    //
    protected $table = 'kardexes';
    protected $fillable = [
        'anio',
        'mes',
        'fecha',
        'fecha_hora',
        'producto_id',
        'establecimiento',
        'tipo_movimiento',
        'comprobante_id',
        'comprobante_detalle_id',
        'tipo_comprobante',
        'fecha_e',
        'ant_cantidad',
        'ant_costo',
        'ant_costo_total',
        'nue_cantidad',
        'nue_costo',
        'nue_costo_total',
        'act_cantidad',
        'act_costo',
        'act_costo_total',
    ];

    public function comprobante()
    {
        return $this->belongsTo(ComprobanteCabecera::class, 'comprobante_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
    public function comprobanteDetalle()
    {
        return $this->belongsTo(ComprobanteDetalle::class, 'comprobante_detalle_id', 'id');
    }
}
