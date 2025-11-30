<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Models\Service;

Route::get('/', function () {
    $services = Service::orderByDesc('created_at')->get();
    return view('services.index', compact('services'));
});

// Service CRUD routes
Route::resource('services', ServiceController::class)->except(['show']);
