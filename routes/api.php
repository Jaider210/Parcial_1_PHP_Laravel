<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CategoriaController;

Route::apiResource('phones', PhoneController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::get('categorias-activas-con-phones', [CategoriaController::class, 'categoriasActivasConPhones']);
