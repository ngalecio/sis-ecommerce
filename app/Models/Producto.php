<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'descripcion',
        'lote',
        'categoria_id',
        'presentacion_id',
        'imagen',
        'lote_estandar',
        'registro_sanitario',
        'tipo_receta',
        'version',
        'stock',
        'precio',
        'costo',
        'imprime_receta',
        'tipo_producto',
        'aplica_iva',
        'aplica_ice',
        'provedor_id',
        'porcentaje_ice',
        'tipo_contribuyente',
        'presentacion',
        'v_min',
        'v_max',
        'v_med',
        'prescripcion',
        'id_producto',
        'precio_compra',
        'fecha_compra',
        'costo_promedio',
        'estado',
    ];

protected $casts = [
    'precio_compra' => 'decimal:2',
];

    public function categoria()
    {
    
    // Especifica las columnas clave foránea y primaria
    // belongsTo(RelatedModel::class, foreignKey, ownerKey)
    // Suponiendo que la columna local es 'categoria_id' y la columna remota es 'id'
    // Puedes ajustar los nombres si son diferentes
    return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class);
    }
}
