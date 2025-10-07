<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'phone_brand' => 'required|string|max:100',
        'phone_model' => 'required|string|max:100',
        'phone_price' => 'required|numeric|min:0',
        'phone_display_size' => 'nullable|integer|min:3|max:10',
        'phone_is_smartphone' => 'boolean',
        'categoria_id' => 'nullable|exists:categorias,id',    // Validación de la llave foránea
        'codigo_barras' => 'required|string|max:255',         // Validación del código de barras
    ];
}
}
