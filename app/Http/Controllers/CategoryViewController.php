<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryViewController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::withCount('phones');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%'.$request->input('search').'%');
        }

        $categories = $query->paginate(10)->withQueryString();

        return Inertia::render('Categorias/Index', [
            'categories' => $categories,
            'filters' => $request->only('search'),
        ]);
    }

    // Formulario de creación de categoría
    public function create()
    {
        return Inertia::render('Categorias/Create');
    }

    // Almacenar nueva categoría en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'prioridad' => 'required|numeric|min:1|max:10',
        ]);

        $validated['fecha_creacion'] = now();

        Categoria::create($validated);

        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    // Formulario de edición de categoría
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return Inertia::render('Categorias/Edit', ['categoria' => $categoria]);
    }

    // Actualizar categoría existente en la base de datos
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'prioridad' => 'required|numeric|min:1|max:10',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($validated);

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar categoría
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
    }

    // Ver detalle de una categoría
    public function show($id)
    {
        // Cargar categoría y registros relacionados 'phones'
        $categoria = Categoria::with('phones')->findOrFail($id);

        return Inertia::render('Categorias/Show', [
            'categoria' => $categoria,
        ]);
    }
}
