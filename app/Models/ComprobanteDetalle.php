<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprobanteDetalle extends Model
{
    //
    protected $table = 'comprobante_detalles';

    protected $fillable
    = [
        'comprobante_id',
        'producto_id',
        'tipo_comprobante',
        'cantidad',
        'precio',
        'descuento',
        'precio_descuento',
        'iva',
        'subtotal',
        'total',
        'cxc_id',
        'cxc_total',
        'cxc_saldo_ant',
        'cxc_abono',
        'cxc_saldo_act',
        'cxp_id',
        'cxp_total',
        'cxp_saldo_ant',
        'cxp_abono',
        'cxp_saldo_act',
        'ice',
        'costo',
        'stock_ant',
        'stock_act',
        'tipo_movimiento',
        'id_cobro',
        'id_cobro_detalle',
        'condicion_credito',
        'valor',
        'cuenta_contable',
        'observacion',
    ];

    public function comprobante()
    {
        return $this->belongsTo(ComprobanteCabecera::class, 'comprobante_id', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }
}
