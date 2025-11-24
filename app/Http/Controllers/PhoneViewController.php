<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PhoneViewController extends Controller
{
    public function index(Request $request)
    {
        $query = Phone::query()->with('categoria');

        // Filtrar por modelo y/o marca si se recibe parámetro
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('phone_model', 'ilike', '%' . $search . '%')
                  ->orWhere('phone_brand', 'ilike', '%' . $search . '%');
            });
        }

        $phones = $query->paginate(10)->withQueryString();

        return Inertia::render('Phones/Index', [
            'phones' => $phones,
            'filters' => $request->only('search'),
        ]);
    }
    // Mostrar formulario de creación de teléfonos
    public function create()
    {
        // Cargar todas las categorías disponibles
        $categorias = \App\Models\Categoria::select('id', 'nombre')->get();

        // Renderizar la vista de creación con categorías
        return \Inertia\Inertia::render('Phones/Create', [
            'categorias' => $categorias,
        ]);
    }
    // Guardar un teléfono nuevo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_brand' => 'required|string|max:100',
            'phone_model' => 'required|string|max:100',
            'phone_price' => 'required|numeric|min:0',
            'phone_display_size' => 'required|numeric|min:1|max:10',
            'phone_is_smartphone' => 'required|boolean',
            'categoria_id' => 'nullable|integer|exists:categorias,id',
            'codigo_barras' => 'nullable|string|max:50',
        ]);

        // Crear el teléfono con los datos validados
        \App\Models\Phone::create($validated);

        return redirect()->route('phones.index')->with('success', 'Teléfono creado exitosamente.');
    }
    // Mostrar formulario de edición
    public function edit($id)
    {
        $phone = \App\Models\Phone::findOrFail($id);
        $categorias = \App\Models\Categoria::select('id', 'nombre')->get();

        return \Inertia\Inertia::render('Phones/Edit', [
            'phone' => $phone,
            'categorias' => $categorias,
        ]);
    }
    // Actualizar teléfono
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'phone_brand' => 'required|string|max:100',
            'phone_model' => 'required|string|max:100',
            'phone_price' => 'required|numeric|min:0',
            'phone_display_size' => 'required|numeric|min:1|max:10',
            'phone_is_smartphone' => 'required|boolean',
            'categoria_id' => 'nullable|integer|exists:categorias,id',
            'codigo_barras' => 'nullable|string|max:50',
        ]);

        $phone = \App\Models\Phone::findOrFail($id);
        $phone->update($validated);

        return redirect()->route('phones.index')->with('success', 'Teléfono actualizado correctamente.');
    }
    // Eliminar teléfono
    public function destroy($id)
    {
        $phone = \App\Models\Phone::findOrFail($id);
        $phone->delete();

        return redirect()->route('phones.index')->with('success', 'Teléfono eliminado correctamente.');
    }
    // Ver detalle de un teléfono
    public function show($id)
    {
        $phone = \App\Models\Phone::with('categoria')->findOrFail($id);
        return \Inertia\Inertia::render('Phones/Show', ['phone' => $phone]);
    }

}
