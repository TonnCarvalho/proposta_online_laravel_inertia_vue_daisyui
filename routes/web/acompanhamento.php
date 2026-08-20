<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/acompanhamento', function(){
        return 'ok';
    })
        ->name('acompanhamento.index');
});
