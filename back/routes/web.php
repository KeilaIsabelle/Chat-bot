<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;  // ← Importação correta

Route::get('/', fn() => view('welcome'));

// Route::apiResource('users', UserController::class);
