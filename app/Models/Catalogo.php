<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    //
    protected $fillable = [
        'codigo',
        'nombre',
    ];
    public function detalles()
    {
        return $this->hasMany(CatalogoDetalle::class);
    }
    
    public function detalles_por_codigo()
    {
        return $this->hasMany(CatalogoDetalle::class, 'codigo_catalogo', 'codigo');
    }
}
