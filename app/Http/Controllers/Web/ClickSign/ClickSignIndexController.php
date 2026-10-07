<?php

namespace App\Http\Controllers\Web\ClickSign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClickSignIndexController extends Controller
{
    public function index()
    {
        return Inertia::render('clicksign/index/ClickSign');
    }
}
