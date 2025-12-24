<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DriverAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;

Route::get('/', function () {
    return view('welcome');
});

// Driver Authentication Routes
Route::prefix('driver')->name('driver.')->group(function () {
    Route::get('login', [DriverAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [DriverAuthController::class, 'login']);
    Route::get('register', [DriverAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [DriverAuthController::class, 'register']);
    Route::post('logout', [DriverAuthController::class, 'logout'])->name('logout');
    
    // Protected Driver Routes
    Route::middleware(['auth', 'check.driver.status'])->group(function () {
        Route::get('dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
        Route::get('search', [DriverController::class, 'search'])->name('search');
        Route::get('report', [DriverController::class, 'showReportForm'])->name('report');
        Route::post('report', [DriverController::class, 'submitReport'])->name('report.submit');
        Route::get('details', [DriverController::class, 'details'])->name('details');
    });
});

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('driver/view/{id}', [AdminController::class, 'viewDriver'])->name('driver.view');
        Route::post('driver/approve/{id}', [AdminController::class, 'approveDriver'])->name('driver.approve');
        Route::post('driver/reject/{id}', [AdminController::class, 'rejectDriver'])->name('driver.reject');
        
        // Bus Management
        Route::get('bus/create', [BusController::class, 'create'])->name('bus.create');
        Route::post('bus/store', [BusController::class, 'store'])->name('bus.store');
        
        // Route Management
        Route::get('route/create', [RouteController::class, 'create'])->name('route.create');
        Route::post('route/store', [RouteController::class, 'store'])->name('route.store');
    });
});

