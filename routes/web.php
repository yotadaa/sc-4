<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlanController::class, 'index'])->name('index');

// Register
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store')
    ->middleware('guest');

// Login
Route::get('/login', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate')
    ->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Display all plans (Assuming you have an index method)
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    // Store a new plan
    Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    // Show edit form
    Route::get('/plans/{id}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    // Update plan
    Route::put('/plans/{id}', [PlanController::class, 'update'])->name('plans.update');
    // Delete plan
    Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{id}', [ProductController::class, 'store'])->name('products.store');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::patch('/product/{plan_id}/{id}/check', [ProductController::class, 'check'])->name('product.check');
});
