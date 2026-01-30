<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogoDetalle extends Model
{
    //
    protected $fillable = [
        'codigo_catalogo_detalle',
        'codigo_catalogo',
        'nombre',
    ];

    public function catalogo_por_codigo()
    {
        return $this->belongsTo(Catalogo::class, 'codigo_catalogo', 'codigo');
    }
    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'catalogo_id', 'id');
    }
}
