<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comprobante_cabeceras', function (Blueprint $table) {
              $table->id();
              $table->string('tipo_comprobante', 2)->nullable();
              $table->date('fecha')->nullable();
              $table->string('numero_comprobante', 20)->nullable();
              $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
              $table->decimal('valor_subtotal_cero', 11, 5)->nullable();
              $table->decimal('valor_subtotal_iva', 11, 5)->nullable();
              $table->decimal('valor_subtotal', 11, 5)->nullable();
              $table->decimal('valor_descuento', 11, 5)->nullable();
              $table->decimal('valor_iva', 11, 5)->nullable();
              $table->decimal('valor_total', 11, 5)->nullable();
              $table->string('notas', 100)->nullable();
              $table->string('clave_acceso', 70)->nullable();
              $table->string('numero_autorizacion', 70)->nullable();
              $table->string('codigo_establecimiento', 20)->nullable();
              $table->string('direccion_destino', 300)->nullable();
              $table->string('motivo', 300)->nullable();
              $table->string('ruta', 300)->nullable();
              $table->integer('id_transportista')->nullable();
              $table->string('fecha_inicio', 12)->nullable();
              $table->string('fecha_final', 12)->nullable();
              $table->string('direccion_partida', 300)->nullable();
              $table->string('placa', 20)->nullable();
              $table->decimal('valor_ice', 11, 5)->nullable();
              $table->decimal('valor_retencion', 11, 5)->nullable();
              $table->decimal('valor_deuda', 11, 5)->nullable();
              $table->decimal('saldo', 11, 5)->nullable();
              $table->string('estado1', 20)->nullable();
              $table->string('estado2', 20)->nullable();
              $table->string('estado3', 20)->nullable();
              $table->string('compra_factura', 20)->nullable();
              $table->dateTime('compra_fecha')->nullable();
              $table->string('compra_autorizacion', 100)->nullable();
              $table->string('compra_sustento_tributario', 10)->nullable();
              $table->string('forma_pago_sri', 10)->nullable();
              $table->string('condicion_credito', 10)->nullable();
              $table->string('tipo_auto', 20)->nullable();
              $table->string('modelo', 100)->nullable();
              $table->string('color', 100)->nullable();
              $table->string('establecimiento', 5)->nullable();
              $table->string('punto_emision', 5)->nullable();
              $table->string('numero_documento', 20)->nullable();
              $table->string('establecimiento_destino', 3)->nullable();
              $table->integer('id_banco')->nullable();
              $table->decimal('valor_deposito', 11, 4)->nullable();
              $table->decimal('valor_caja_chica', 11, 4)->nullable();
              $table->string('forma_pago', 2)->nullable();
              $table->string('fecha_autorizacion', 30)->nullable();
              $table->string('banco_tipo_movimiento', 4)->nullable();
              $table->decimal('banco_valor', 11, 5)->nullable();
              $table->char('banco_estado', 1)->nullable();
              $table->date('banco_fecha')->nullable();
              $table->string('banco_fecha_e', 12)->nullable();
              $table->string('banco_anio_e', 4)->nullable();
              $table->string('banco_mes_e', 2)->nullable();
              $table->string('banco_periodo_e', 6)->nullable();
              $table->string('fecha_e', 10)->nullable();
              $table->string('anio_e', 4)->nullable();
              $table->string('mes_e', 2)->nullable();
              $table->string('periodo_e', 6)->nullable();
              $table->string('banco_numero_documento', 20)->nullable();
              $table->string('banco_numero_movimiento', 20)->nullable();
              $table->integer('nc_id_factura')->nullable();
              $table->string('nc_factura', 20)->nullable();
              $table->string('nc_motivo', 200)->nullable();
              $table->string('nc_afecta_inventario', 2)->nullable();
              $table->string('ret_numero', 20)->nullable();
              $table->string('ret_autorizacion', 100)->nullable();
              $table->date('ret_fecha')->nullable();
              $table->decimal('ret_base_1', 11, 5)->nullable();
              $table->decimal('ret_porcentaje_1', 11, 5)->nullable();
              $table->decimal('ret_valor_1', 11, 5)->nullable();
              $table->decimal('ret_base_2', 11, 5)->nullable();
              $table->decimal('ret_porcentaje_2', 11, 5)->nullable();
              $table->decimal('ret_valor_2', 11, 5)->nullable();
              $table->decimal('ret_total', 11, 5)->nullable();
              $table->string('cb_banco', 20)->nullable();
              $table->string('cb_documento', 20)->nullable();
              $table->date('cb_fecha')->nullable();
              $table->integer('ret_id_tipo_1')->nullable();
              $table->string('ret_tipo_1', 20)->nullable();
              $table->integer('ret_id_tipo_2')->nullable();
              $table->string('ret_tipo_2', 20)->nullable();
              $table->integer('anio')->nullable();
              $table->integer('mes')->nullable();
              $table->integer('dia')->nullable();
              $table->string('electronica', 2)->nullable();
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobante_cabeceras');
    }
};
