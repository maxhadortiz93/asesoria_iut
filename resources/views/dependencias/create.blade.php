@extends('layouts.base')

@section('title', 'Crear Dependencia')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nueva Dependencia</h1>

            <form action="{{ route('dependencias.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Unidad Administradora -->
                <div>
                    <label for="unidad_administradora_id" class="block text-sm font-medium text-gray-700">
                        Unidad Administradora
                    </label>
                    <select name="unidad_administradora_id" id="unidad_administradora_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Seleccione...</option>
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->id }}" {{ old('unidad_administradora_id') == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_administradora_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                           placeholder="Ej: Dirección de Finanzas"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código -->
                <div>
                    <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                           placeholder="Ej: DEP-001"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-blue-500 focus:ring-blue-500 sm:text-sm font-mono">
                    @error('codigo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('dependencias.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


