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
        Schema::create('tipo_comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10);
            $table->string('nombre', 100);
            $table->string('sescuento_ventas', 20);
            $table->string('ice_ventas', 20);
            $table->string('costo_ventas', 20);
            $table->string('inventario', 20);
            $table->string('cuentas_por_pagar', 20);
            $table->string('iva_compras', 20);
            $table->string('retencion_fuente', 20);
            $table->string('retencion_iva', 20);
            $table->string('otra_cuenta', 20);
            $table->string('nombre_ventas', 200);
            $table->string('nombre_cuentas_por_cobrar', 200);
            $table->string('nombre_iva_ventas', 200);
            $table->string('nombre_descuento_ventas', 200);
            $table->string('nombre_ice_ventas', 200);
            $table->string('nombre_costo_ventas', 200);
            $table->string('nombre_inventario', 200);
            $table->string('nombre_cuentas_por_pagar', 200);
            $table->string('nombre_iva_compras', 200);
            $table->string('nombre_retencion_fuente', 200);
            $table->string('nombre_retencion_iva', 200);
            $table->string('nombre_otra_cuenta', 200);
            $table->string('ventas', 20);
            $table->string('cuentas_por_cobrar', 20);
            $table->string('iva_ventas', 20);
            $table->string('tiene_asiento', 2);
            $table->string('caja_recaudacion', 20);
            $table->string('caja_cierre', 20);
            $table->string('caja_chica', 20);
            $table->string('nombre_caja_recaudacion', 20);
            $table->string('nombre_caja_cierre', 20);
            $table->string('nombre_caja_chica', 20);
            $table->char('nat1', 1);
            $table->char('nat2', 1);
            $table->char('nat3', 1);
            $table->char('nat4', 1);
            $table->char('nat5', 1);
            $table->char('nat6', 1);
            $table->char('nat7', 1);
            $table->char('nat8', 1);
            $table->char('nat9', 1);
            $table->char('nat10', 1);
            $table->char('nat11', 1);
            $table->char('nat12', 1);
            $table->char('nat13', 1);
            $table->char('nat14', 1);
            $table->char('nat15', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_comprobantes');
    }
};
