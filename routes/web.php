<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login', 301);

require __DIR__ .'/web/auth.php';
require __DIR__ .'/web/acompanhamento.php';
require __DIR__ .'/web/associado.php';
require __DIR__ .'/web/proposta.php';
require __DIR__ .'/web/orgao.php';