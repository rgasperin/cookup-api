<?php

use App\Http\Controllers\Api\V1\IngredientController;
use App\Http\Controllers\Api\V1\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/ingredientes', [IngredientController::class, 'index']);
Route::get('/ingredientes/{id}', [IngredientController::class, 'show']);
Route::post('/ingredientes', [IngredientController::class, 'store']);
Route::put('/ingredientes/{id}', [IngredientController::class, 'update']);
Route::delete('/ingredientes/{id}', [IngredientController::class, 'destroy']);

// Receitas
Route::get('/receitas', [RecipeController::class, 'index']);
Route::get('/receitas/{id}', [RecipeController::class, 'show']);
Route::post('/receitas/buscar-ingredientes', [RecipeController::class, 'findByIngredients']);
Route::post('/receitas', [RecipeController::class, 'store']);
Route::put('/receitas/{id}', [RecipeController::class, 'update']);
Route::delete('/receitas/{id}', [RecipeController::class, 'destroy']);
