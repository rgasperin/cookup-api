<?php

use App\Http\Controllers\CookupController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\TypesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [CookupController::class, 'index']);

Route::get('/receitas', [CookupController::class, 'index']);
Route::get('/receitas/{id}', [CookupController::class, 'show']);
Route::get('/criar', [CookupController::class, 'create']);
Route::post('/receitas', [CookupController::class, 'store']);
Route::get('/receitas/{id}/editar', [CookupController::class, 'edit']);
Route::put('/receitas/{id}', [CookupController::class, 'update']);
Route::delete('/receitas/{id}', [CookupController::class, 'destroy']);
Route::post('/buscar-ingredientes', [CookupController::class, 'findByIngredients']);

Route::get('/ingredientes', [IngredientsController::class, 'index']);
Route::get('/ingredientes/criar', [IngredientsController::class, 'create']);
Route::post('/ingredientes', [IngredientsController::class, 'store']);
Route::get('/ingredientes/{id}/editar', [IngredientsController::class, 'edit']);
Route::put('/ingredientes/{id}', [IngredientsController::class, 'update']);
Route::delete('/ingredientes/{id}', [IngredientsController::class, 'destroy']);

Route::get('/tipos', [TypesController::class, 'index']);
Route::get('/tipos/criar', [TypesController::class, 'create']);
Route::post('/tipos', [TypesController::class, 'store']);
Route::get('/tipos/{id}/editar', [TypesController::class, 'edit']);
Route::put('/tipos/{id}', [TypesController::class, 'update']);
Route::delete('/tipos/{id}', [TypesController::class, 'destroy']);
