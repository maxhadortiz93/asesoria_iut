<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Listar todos los usuarios.
     */
    public function index()
    {
        // Incluimos la relación con rol para evitar N+1
        $usuarios = Usuario::with('rol')->paginate(10);

        return response()->json($usuarios);
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rol_id'        => ['required', 'exists:roles,id'],
            'cedula'        => ['required', 'string', 'max:20', 'unique:usuarios,cedula'],
            'nombre'        => ['required', 'string', 'max:255'],
            'correo'        => ['required', 'email', 'max:255', 'unique:usuarios,correo'],
            'hash_password' => ['required', 'string', 'min:8'],
            'activo'        => ['boolean'],
        ]);

        // Hashear la contraseña antes de guardar
        $validated['hash_password'] = Hash::make($validated['hash_password']);

        $usuario = Usuario::create($validated);

        return response()->json($usuario, 201);
    }

    /**
     * Mostrar un usuario específico.
     */
    public function show(Usuario $usuario)
    {
        $usuario->load(['rol', 'reportes', 'movimientos']);

        return response()->json($usuario);
    }

    /**
     * Actualizar un usuario.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'rol_id'        => ['sometimes', 'exists:roles,id'],
            'cedula'        => [
                'sometimes',
                'string',
                'max:20',
                Rule::unique('usuarios', 'cedula')->ignore($usuario->id),
            ],
            'nombre'        => ['sometimes', 'string', 'max:255'],
            'correo'        => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('usuarios', 'correo')->ignore($usuario->id),
            ],
            'hash_password' => ['nullable', 'string', 'min:8'],
            'activo'        => ['boolean'],
        ]);

        // Si se envía una nueva contraseña, la hasheamos
        if (!empty($validated['hash_password'])) {
            $validated['hash_password'] = Hash::make($validated['hash_password']);
        }

        $usuario->update($validated);

        return response()->json($usuario);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->json(null, 204);
    }
}
