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
        Schema::create('comprobante_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprobante_id')->constrained('comprobante_cabeceras')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->string('tipo_comprobante', 2)->nullable()->default(null);
            $table->decimal('cantidad', 11, 2)->nullable()->default(null);
            $table->decimal('precio', 11, 5)->nullable()->default(null);
            $table->decimal('descuento', 11, 5)->nullable()->default(null);
            $table->decimal('precio_descuento', 11, 5)->nullable()->default(null);
            $table->decimal('iva', 11, 5)->nullable()->default(null);
            $table->decimal('subtotal', 11, 5)->nullable()->default(null);
            $table->decimal('total', 11, 5)->nullable()->default(null);
            $table->integer('cxc_id')->nullable()->default(null);
            $table->decimal('cxc_total', 11, 5)->nullable()->default(null);
            $table->decimal('cxc_saldo_ant', 11, 5)->nullable()->default(null);
            $table->decimal('cxc_abono', 11, 5)->nullable()->default(null);
            $table->decimal('cxc_saldo_act', 11, 5)->nullable()->default(null);
            $table->integer('cxp_id')->nullable()->default(null);
            $table->decimal('cxp_total', 11, 5)->nullable()->default(null);
            $table->decimal('cxp_saldo_ant', 11, 5)->nullable()->default(null);
            $table->decimal('cxp_abono', 11, 5)->nullable()->default(null);
            $table->decimal('cxp_saldo_act', 11, 5)->nullable()->default(null);
            $table->decimal('ice', 11, 5)->nullable()->default(null);
            $table->decimal('costo', 11, 5)->nullable()->default(null);
            $table->decimal('stock_ant', 11, 5)->nullable()->default(null);
            $table->decimal('stock_act', 11, 5)->nullable()->default(null);
            $table->string('tipo_movimiento', 20)->nullable()->default(null);
            $table->integer('id_cobro')->nullable()->default(null);
            $table->integer('id_cobro_detalle')->nullable()->default(null);
            $table->string('condicion_credito', 20)->nullable()->default(null);
            $table->decimal('valor', 11, 5)->nullable()->default(null);
            $table->string('cuenta_contable', 20)->nullable()->default(null);
            $table->string('observacion', 500)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobante_detalles');
    }
};
