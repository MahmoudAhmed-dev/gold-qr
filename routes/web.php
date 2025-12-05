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
    Route::get('/bars/{bar}', [BarController::class, 'show'])->name('bars.show');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});
