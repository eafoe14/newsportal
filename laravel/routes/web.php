<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Аутентификация
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Защищенные маршруты
Route::middleware('auth')->group(function () {
    
    // Профиль
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Для всех пользователей
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.my');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

    // Только для рекламного отдела - проверка роли в контроллере
    Route::prefix('advertiser')->group(function () {
        Route::get('/dashboard', [ApplicationController::class, 'dashboard'])->name('advertiser.dashboard');
        Route::get('/applications', [ApplicationController::class, 'index'])->name('advertiser.applications');
        Route::put('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
    });
});