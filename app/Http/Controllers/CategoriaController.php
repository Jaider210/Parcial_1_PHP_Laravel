<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Listar todas las categorías
    public function index()
    {
        return response()->json(Categoria::all(), 200);
    }

    // Crear una nueva categoría con Form Request
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = Categoria::create($request->validated());
        return response()->json($categoria, 201);
    }

    // Mostrar una categoría específica
    public function show(Categoria $categoria)
    {
        return response()->json($categoria, 200);
    }

    // Actualizar una categoría con Form Request
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());
        return response()->json($categoria, 200);
    }

    // Eliminar una categoría
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(null, 204);
    }

    // Método adicional: listar categorías activas con teléfonos
    public function categoriasActivasConPhones()
    {
        $categorias = Categoria::where('estado', true)
                        ->with('phones')
                        ->get();

        return response()->json($categorias);
    }
}
