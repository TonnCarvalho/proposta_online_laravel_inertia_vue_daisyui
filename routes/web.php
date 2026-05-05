<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

require __DIR__ .'/web/auth.php';
require __DIR__ .'/web/proposta.php';