<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    /**
     * Listar todos los roles.
     */
    public function index()
    {
        // Incluimos la relación con usuarios para evitar N+1
        $roles = Rol::with('usuarios')->paginate(10);

        return response()->json($roles);
    }

    /**
     * Guardar un nuevo rol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'   => ['required', 'string', 'max:255', 'unique:roles,nombre'],
            'permisos' => ['nullable', 'array'],
        ]);

        $rol = Rol::create($validated);

        return response()->json($rol, 201);
    }

    /**
     * Mostrar un rol específico.
     */
    public function show(Rol $rol)
    {
        $rol->load('usuarios');

        return response()->json($rol);
    }

    /**
     * Actualizar un rol.
     */
    public function update(Request $request, Rol $rol)
    {
        $validated = $request->validate([
            'nombre'   => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('roles', 'nombre')->ignore($rol->id),
            ],
            'permisos' => ['nullable', 'array'],
        ]);

        $rol->update($validated);

        return response()->json($rol);
    }

    /**
     * Eliminar un rol.
     */
    public function destroy(Rol $rol)
    {
        $rol->delete();

        return response()->json(null, 204);
    }
}
