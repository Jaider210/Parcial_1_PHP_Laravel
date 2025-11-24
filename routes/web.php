<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\PhoneViewController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Listado de categorías
    Route::get('/categories', [CategoryViewController::class, 'index'])->name('categories.index');
    // Formulario de creación
    Route::get('/categories/create', [CategoryViewController::class, 'create'])->name('categories.create');
    // Guardar nueva categoría
    Route::post('/categories', [CategoryViewController::class, 'store'])->name('categories.store');
    // Formulario de edición
    Route::get('/categories/{id}/edit', [CategoryViewController::class, 'edit'])->name('categories.edit');
    // Actualizar categoría
    Route::put('/categories/{id}', [CategoryViewController::class, 'update'])->name('categories.update');
    // Eliminar categoría
    Route::delete('/categories/{id}', [CategoryViewController::class, 'destroy'])->name('categories.destroy');
    // Ver detalle de una categoría
    Route::get('/categories/{id}', [CategoryViewController::class, 'show'])->name('categories.show');

    // Listado de teléfonos
    Route::get('/phones', [PhoneViewController::class, 'index'])->name('phones.index');
    // Mostrar formulario de creación de teléfonos
    Route::get('/phones/create', [PhoneViewController::class, 'create'])->name('phones.create');
    // Guardar un teléfono nuevo
    Route::post('/phones', [PhoneViewController::class, 'store'])->name('phones.store');
    // Mostrar formulario de edición
    Route::get('/phones/{id}/edit', [PhoneViewController::class, 'edit'])->name('phones.edit');
    // Actualizar teléfono
    Route::put('/phones/{id}', [PhoneViewController::class, 'update'])->name('phones.update');
    // Eliminar teléfono
    Route::delete('/phones/{id}', [PhoneViewController::class, 'destroy'])->name('phones.destroy');
    // Vista detalle teléfono
    Route::get('/phones/{id}', [PhoneViewController::class, 'show'])->name('phones.show');

});
