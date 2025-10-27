<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Listar usuarios con opción de búsqueda por nombre.
     */
    public function index(Request $request)
    {
        $usuarios = Usuario::with('rol')
            ->when($request->filled('nombre'), function ($query) use ($request) {
                $query->where('nombre', 'like', '%' . $request->nombre . '%');
            })
            ->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario para crear usuario.
     */
    public function create()
    {
        $roles = \App\Models\Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        // Solo administradores pueden crear usuarios
        if (!auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'No tienes permisos para crear usuarios.',
            ], 403);
        }

        // Obtener el rol Administrador
        $rolAdmin = \App\Models\Rol::where('nombre', 'Administrador')->first();
        
        $validated = $request->validate(
            [
                'rol_id'        => ['required', 'exists:roles,id'],
                'cedula'        => ['required', 'string', 'max:20', 'unique:usuarios,cedula', 'regex:/^V-\d{2}\.\d{3}\.\d{3}$/'],
                'nombre'        => ['required', 'string', 'max:150'],
                'apellido'      => ['required', 'string', 'max:150'],
                'correo'        => ['required', 'email', 'max:255', 'unique:usuarios,correo'],
                'hash_password' => ['required', 'string', 'min:8'],
                'activo'        => ['boolean'],
                'is_admin'      => ['boolean'],
            ],
            [
                'cedula.regex' => 'La cédula debe tener el formato V-XX.XXX.XXX',
                'cedula.unique' => 'Esta cédula ya está registrada',
                'correo.unique' => 'Este correo ya está registrado',
                'apellido.required' => 'El apellido es requerido',
            ]
        );
        
        // Validar que no intente seleccionar rol de Administrador si no es admin
        if ($rolAdmin && $validated['rol_id'] == $rolAdmin->id && !auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Solo administradores pueden asignar el rol de Administrador.',
            ], 403);
        }

        // Solo administradores pueden crear otros administradores
        if ($request->boolean('is_admin') && !auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Solo administradores pueden crear otros administradores.',
            ], 403);
        }

        // Forzar coherencia: si rol es Administrador => is_admin = true; caso contrario false
        if ($rolAdmin) {
            $validated['is_admin'] = ((int)$validated['rol_id'] === (int)$rolAdmin->id);
        }

        $validated['hash_password'] = Hash::make($validated['hash_password']);

        $usuario = Usuario::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Usuario creado correctamente',
                'usuario' => $usuario,
            ], 201);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Mostrar detalles de un usuario.
     */
    public function show(Usuario $usuario)
    {
        $usuario->load(['rol', 'reportes', 'movimientos']);

        return response()->json($usuario);
    }

    /**
     * Actualizar datos de un usuario.
     */
    public function update(Request $request, Usuario $usuario)
    {
        // Solo administradores pueden actualizar usuarios
        if (!auth()->user()->canDeleteData()) {
            return abort(403, 'No tienes permisos para actualizar usuarios.');
        }

        $validated = $request->validate([
            'rol_id'        => ['sometimes', 'exists:roles,id'],
            'cedula'        => [
                'sometimes', 'string', 'max:20',
                Rule::unique('usuarios', 'cedula')->ignore($usuario->id),
            ],
            'nombre'        => ['sometimes', 'string', 'max:150'],
            'apellido'      => ['sometimes', 'string', 'max:150'],
            'correo'        => [
                'sometimes', 'email', 'max:255',
                Rule::unique('usuarios', 'correo')->ignore($usuario->id),
            ],
            'hash_password' => ['nullable', 'string', 'min:8'],
            'activo'        => ['boolean'],
            'is_admin'      => ['boolean'],
        ]);

        // Solo administradores pueden asignar permisos de administrador
        if (isset($validated['is_admin']) && $validated['is_admin'] && !auth()->user()->isAdmin()) {
            return abort(403, 'Solo administradores pueden asignar permisos de administrador.');
        }

        // Forzar coherencia de is_admin con rol seleccionado
        $rolAdmin = \App\Models\Rol::where('nombre', 'Administrador')->first();
        if ($rolAdmin && isset($validated['rol_id'])) {
            $validated['is_admin'] = ((int)$validated['rol_id'] === (int)$rolAdmin->id);
        }

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
        // Solo administradores pueden eliminar datos
        if (!auth()->user()->canDeleteUser($usuario)) {
            return abort(403, 'No tienes permisos para eliminar este usuario. No puedes eliminar administradores ni a ti mismo.');
        }

        $usuario->delete();

        return response()->json(null, 204);
    }
}

