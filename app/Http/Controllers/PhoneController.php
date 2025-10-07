<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Requests\StorePhoneRequest;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index()
    {
        // Si quieres, puedes incluir la categoría aquí también:
        return Phone::with('categoria')->get();
    }

    public function store(StorePhoneRequest $request)
    {
        return Phone::create($request->validated());
    }

    public function show($id)
    {
        // Incluye toda la info de la categoría relacionada
        $phone = Phone::with('categoria')->findOrFail($id);
        return response()->json($phone);
    }

    public function update(StorePhoneRequest $request, $id)
    {
        $phone = Phone::findOrFail($id);
        $phone->update($request->validated());
        return $phone;
    }

    public function destroy($id)
    {
        $phone = Phone::findOrFail($id);
        $phone->delete();
        return response()->json(['message' => 'Phone deleted successfully']);
    }
}
