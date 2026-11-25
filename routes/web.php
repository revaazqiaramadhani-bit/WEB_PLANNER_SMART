<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;

// Route untuk Login & Logout (Bisa diakses siapa saja yang belum login)
Route::get('/login', [SessionController::class, 'index'])->name('login');
Route::post('/login', [SessionController::class, 'login']);
Route::get('/register', [SessionController::class, 'register'])->name('register');
Route::post('/register', [SessionController::class, 'storeRegistration']);
Route::post('/logout', [SessionController::class, 'logout']);

// Route yang dilindungi Middleware (Hanya bisa dibuka setelah Login)
Route::middleware(['auth'])->group(function () {
    // Plans (CRUD & Toggle Status)
    Route::get('/plans', [PlanController::class, 'index']);
    Route::post('/plans', [PlanController::class, 'store']);
    Route::get('/plans/{id}/edit', [PlanController::class, 'edit']);
    Route::put('/plans/{id}', [PlanController::class, 'update']);
    Route::delete('/plans/{id}', [PlanController::class, 'destroy']);
    Route::patch('/plans/{id}/toggle', [PlanController::class, 'toggleStatus']);

    // Categories (Resource Controller)
    Route::resource('categories', CategoryController::class);
});
