<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect(session('locale', config('app.locale', 'ar')));
});

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|ar']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Auth Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.store');

        // Password Reset Routes
        // Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
        // Route::post('/forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
        // Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
        // Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    // Public Routes
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::post('/search', [SearchController::class, 'find'])->name('search.find');

    // Protected Routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/bars', [BarController::class, 'index'])->name('bars.index');
        Route::get('/bars/create', [BarController::class, 'create'])->name('bars.create');
        Route::post('/bars', [BarController::class, 'store'])->name('bars.store');
        Route::get('/bars/{bar}/edit', [BarController::class, 'edit'])->name('bars.edit');
        Route::put('/bars/{bar}', [BarController::class, 'update'])->name('bars.update');
        Route::delete('/bars/{bar}', [BarController::class, 'destroy'])->name('bars.destroy');
    });
    Route::get('/bars/{bar}', [BarController::class, 'show'])->name('bars.show');
});

Route::fallback(function () {
    $locale = request()->segment(1);
    if (in_array($locale, ['en', 'ar'])) {
        app()->setLocale($locale);
        abort(404);
    }
    return redirect('/' . session('locale', config('app.locale', 'ar')) . request()->getRequestUri());
});
