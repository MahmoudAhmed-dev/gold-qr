<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarController;



Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/bars', [BarController::class, 'index'])->name('bars.index');
    Route::get('/bars/{bar}', [BarController::class, 'show'])->name('bars.show');
});
