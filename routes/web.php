<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => '{locale}'], function () {
    
});
