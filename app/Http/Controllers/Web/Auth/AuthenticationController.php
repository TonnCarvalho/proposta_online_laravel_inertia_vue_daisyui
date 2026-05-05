<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthenticationController extends Controller
{
    public function index()
    {
        return Inertia::render('auth/Login');
    }

    public function store(Request $request, AuthenticationService $authenticationService)
    {
        $credentials = $request->validate([
            'cod_corretor' => ['required', 'integer'],
            'password' => ['required'],
        ]);

        $authenticated = $authenticationService->authenticate(
            $credentials['cod_corretor'], $credentials['password']);

        if (! $authenticated) {
            throw ValidationException::withMessages([
                'credentials' => 'Código ou senha incorreta',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/proposta');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }
}
