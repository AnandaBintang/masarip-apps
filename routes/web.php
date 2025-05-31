<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilDesaController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\SaranaSimpanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect()->route('loginForm');
})->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

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

    Route::prefix('sarana-simpan')->name('sarana_simpan.')->group(function () {
        Route::get('/', [SaranaSimpanController::class, 'index'])
            ->name('index');
        Route::get('/create', [SaranaSimpanController::class, 'create'])
            ->name('create');
        Route::post('/store', [SaranaSimpanController::class, 'store'])
            ->name('store');
        Route::get('/{saranaSimpan}/edit', [SaranaSimpanController::class, 'edit'])
            ->name('edit');
        Route::put('/{saranaSimpan}', [SaranaSimpanController::class, 'update'])
            ->name('update');
        Route::delete('/{saranaSimpan}', [SaranaSimpanController::class, 'destroy'])
            ->name('destroy');
    });

    Route::prefix('profil-desa')->name('profil_desa.')->group(function () {
        Route::get('/', [ProfilDesaController::class, 'index'])
            ->name('index');
        Route::post('/store', [ProfilDesaController::class, 'store'])
            ->name('store');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/show', [ProfileUserController::class, 'showProfile'])
            ->name('show');
        Route::post('/update', [ProfileUserController::class, 'updateProfile'])
            ->name('update');
    });
});

Route::get('/setup', function () {
    Artisan::call('key:generate');
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);
    Artisan::call('storage:link');

    return 'Setup completed. All artisan commands have been executed.';
});
