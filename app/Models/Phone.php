<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_phone';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'phone_brand',
        'phone_model',
        'phone_price',
        'phone_display_size',
        'phone_is_smartphone',
        'categoria_id',
        'codigo_barras',
    ];

    // Definir relación con Categoria (pertenece a)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
