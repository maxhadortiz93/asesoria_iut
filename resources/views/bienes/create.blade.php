@extends('layouts.base')

@section('title', 'Crear Bien')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar Nuevo Bien</h1>

            <form action="{{ route('bienes.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Dependencia -->
                <div>
                    <label for="dependencia_id" class="block text-sm font-medium text-gray-700">Dependencia</label>
                    <select name="dependencia_id" id="dependencia_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Seleccione...</option>
                        @foreach($dependencias as $dep)
                            <option value="{{ $dep->id }}" {{ old('dependencia_id') == $dep->id ? 'selected' : '' }}>
                                {{ $dep->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('dependencia_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Responsable -->
                <div>
                    <label for="responsable_id" class="block text-sm font-medium text-gray-700">Responsable</label>
                    <select name="responsable_id" id="responsable_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Seleccione...</option>
                        @foreach($responsables as $resp)
                            <option value="{{ $resp->id }}" {{ old('responsable_id') == $resp->id ? 'selected' : '' }}>
                                {{ $resp->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('responsable_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código -->
                <div>
                    <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('codigo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ubicación -->
                <div>
                    <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{ old('ubicacion') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('ubicacion')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="estado" id="estado"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Seleccione...</option>
                        @foreach(\App\Enums\EstadoBien::cases() as $estado)
                            <option value="{{ $estado->value }}" {{ old('estado') == $estado->value ? 'selected' : '' }}>
                                {{ ucfirst($estado->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de registro -->
                <div>
                    <label for="fecha_registro" class="block text-sm font-medium text-gray-700">Fecha de Registro</label>
                    <input type="date" name="fecha_registro" id="fecha_registro" value="{{ old('fecha_registro') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('fecha_registro')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('bienes.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancelar</a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

