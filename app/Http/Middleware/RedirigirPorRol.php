<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirigirPorRol
{
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = \Illuminate\Support\Facades\Auth::user();

        if (!$usuario) {
            return redirect('/login');
        }

        switch ($usuario->rol_id) {
            case 1:
                return $next($request);

            case 2:
                return redirect()->route('bienes.index');

            default:
                return redirect('/login')->with('error', 'Rol no autorizado');
        }
    }
}


