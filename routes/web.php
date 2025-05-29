<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('loginForm');
})->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])
            ->name('index');
        Route::get('/create', [UserController::class, 'create'])
            ->name('create');
        Route::post('/store', [UserController::class, 'store'])
            ->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])
            ->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])
            ->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])
            ->name('destroy');
    });

    Route::get('/status', [StatusController::class, 'index'])
        ->name('status.index');

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->name('index');
        Route::get('/create', [CategoryController::class, 'create'])
            ->name('create');
        Route::post('/store', [CategoryController::class, 'store'])
            ->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])
            ->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])
            ->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])
            ->name('destroy');
    });
});
