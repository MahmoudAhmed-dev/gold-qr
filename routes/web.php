<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/bars', [BarController::class, 'index'])->name('bars.index');
    Route::get('/bars/create', [BarController::class, 'create'])->name('bars.create');
    Route::post('/bars', [BarController::class, 'store'])->name('bars.store');
    Route::get('/bars/{bar}', [BarController::class, 'show'])->name('bars.show');
    Route::get('/bars/{bar}/edit', [BarController::class, 'edit'])->name('bars.edit');
    Route::put('/bars/{bar}', [BarController::class, 'update'])->name('bars.update');
    Route::delete('/bars/{bar}', [BarController::class, 'destroy'])->name('bars.destroy');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::post('/search', [SearchController::class, 'find'])->name('search.find');
});
