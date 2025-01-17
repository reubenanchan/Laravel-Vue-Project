<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoController;

Route::apiResource('todos', TodoController::class);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'title' => 'Welcome to Inertia',
    ]);

});
