<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Define los campos asignables en masa
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'fecha_creacion',
        'prioridad'
    ];

    // Definición de la relación uno a muchos con Phone
    public function phones()
    {
        return $this->hasMany(Phone::class, 'categoria_id');
    }
}
