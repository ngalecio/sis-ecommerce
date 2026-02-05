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
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->string('anio', 4)->nullable();
            $table->string('mes', 2)->nullable();
            $table->date('fecha')->nullable();
            $table->dateTime('fecha_hora')->nullable();
            $table->string('producto_id', 20)->nullable();
            $table->string('establecimiento', 5)->nullable();
            $table->string('tipo_movimiento', 2)->nullable();
            $table->integer('comprobante_id')->nullable();
            $table->integer('comprobante_detalle_id')->nullable();
            $table->string('tipo_comprobante', 4)->nullable();
            $table->string('fecha_e', 12)->nullable();
            $table->decimal('ant_cantidad', 11, 5)->nullable();
            $table->decimal('ant_costo', 11, 5)->nullable();
            $table->decimal('ant_costo_total', 11, 5)->nullable();
            $table->decimal('nue_cantidad', 11, 5)->nullable();
            $table->decimal('nue_costo', 11, 5)->nullable();
            $table->decimal('nue_costo_total', 11, 5)->nullable();
            $table->decimal('act_cantidad', 11, 5)->nullable();
            $table->decimal('act_costo', 11, 5)->nullable();
            $table->decimal('act_costo_total', 11, 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kardexes');
    }
};
