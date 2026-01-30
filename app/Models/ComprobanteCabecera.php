<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprobanteCabecera extends Model
{
    //
    protected $table = 'comprobante_cabeceras';
    protected $fillable = [
        'tipo_comprobante',
        'fecha',
        'numero_comprobante',
        'cliente_id',
        'valor_subtotal_cero',
        'valor_subtotal_iva',
        'valor_subtotal',
        'valor_descuento',
        'valor_iva',
        'valor_total',
        'notas',
        'clave_acceso',
        'numero_autorizacion',
        'codigo_establecimiento',
        'direccion_destino',
        'motivo',
        'ruta',
        'id_transportista',
        'fecha_inicio',
        'fecha_final',
        'direccion_partida',
        'placa',
        'valor_ice',
        'valor_retencion',
        'valor_deuda',
        'saldo',
        'estado1',
        'estado2',
        'estado3',
        'compra_factura',
        'compra_fecha',
        'compra_autorizacion',
        'compra_sustento_tributario',
        'forma_pago_sri',
        'condicion_credito',
        'tipo_auto',
        'modelo',
        'color',
        'establecimiento',
        'punto_emision',
        'numero_documento',
        'establecimiento_destino',
        'id_banco',
        'valor_deposito',
        'valor_caja_chica',
        'forma_pago',
        'fecha_autorizacion',
        'banco_tipo_movimiento',
        'banco_valor',
        'banco_estado',
        'banco_fecha',
        'banco_fecha_e',
        'banco_anio_e',
        'banco_mes_e',
        'banco_periodo_e',
        'fecha_e',
        'anio_e',
        'mes_e',
        'periodo_e',
        'banco_numero_documento',
        'banco_numero_movimiento',
        'nc_id_factura',
        'nc_factura',
        'nc_motivo',
        'nc_afecta_inventario',
        'ret_numero',
        'ret_autorizacion',
        'ret_fecha',
        'ret_base_1',
        'ret_porcentaje_1',
        'ret_valor_1',
        'ret_base_2',
        'ret_porcentaje_2',
        'ret_valor_2',
        'ret_total',
        'cb_banco',
        'cb_documento',
        'cb_fecha',
        'ret_id_tipo_1',
        'ret_tipo_1',
        'ret_id_tipo_2',
        'ret_tipo_2',
        'anio',
        'mes',
        'dia',
        'electronica',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detalles()
    {
       
        return $this->hasMany(ComprobanteDetalle::class, 'comprobante_id', 'id');
    }
}
