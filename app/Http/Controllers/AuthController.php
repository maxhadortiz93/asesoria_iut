<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'password');
        $credentials['activo'] = true;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirigir según el rol
            $usuario = Auth::user();
            switch ($usuario->rol_id) {
                case 1:
                    return redirect()->intended('/usuarios');
                case 2:
                    return redirect()->intended('/bienes');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Rol no autorizado');
            }
        }

        return back()->with('error', 'Credenciales inválidas')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}


