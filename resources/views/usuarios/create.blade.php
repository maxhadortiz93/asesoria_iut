@extends('layouts.base')

@section('title', 'Crear Usuario')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nuevo Usuario</h1>
        
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="cedula" class="block text-sm font-medium text-gray-700">Cédula</label>
                <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('cedula')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('nombre')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" id="correo" value="{{ old('correo') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('correo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rol_id" class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="rol_id" id="rol_id" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('rol_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="hash_password" id="password" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('hash_password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Guardar
                </button>
                <a href="{{ route('usuarios.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
