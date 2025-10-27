@extends('layouts.base')

@section('title', 'Usuarios')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nuevo Usuario
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Cédula</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Correo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Rol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Estado</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $usuario->cedula }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $usuario->nombre }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $usuario->correo }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $usuario->rol->nombre ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if($usuario->is_admin)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-purple-800 bg-purple-100 rounded-full">Administrador</span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">Usuario</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($usuario->activo)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Activo</span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="text-blue-600 hover:underline">Editar</a>
                        @if(auth()->user()->canDeleteUser($usuario))
                            <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" style="display: inline;" onsubmit="return confirm('¿Estás seguro? No podrás deshacer esta acción.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm">No puedes eliminar</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No hay usuarios registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($usuarios->hasPages())
    <div class="mt-6">
        {{ $usuarios->links() }}
    </div>
@endif
@endsection
