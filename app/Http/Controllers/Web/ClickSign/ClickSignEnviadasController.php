<?php

namespace App\Http\Controllers\Web\ClickSign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClickSignEnviadasController extends Controller
{
    public function enviadas()
    {
        return Inertia::render('clicksign/enviadas/Enviadas');
    }
}
