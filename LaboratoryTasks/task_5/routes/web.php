<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Categories CRUD
Route::resource('categories', CategoryController::class);

// Recipes CRUD
Route::resource('recipes', RecipeController::class);
