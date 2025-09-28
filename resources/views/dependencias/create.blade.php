<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Dependencia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    @include('layouts.head')

    <!-- Contenido principal -->
    <main class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center space-x-2">
                <x-heroicon-o-link class="w-7 h-7 text-blue-600"/>
                <span>Registrar nueva Dependencia</span>
            </h2>

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
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <x-heroicon-o-exclamation-circle class="w-4 h-4 mr-1"/> {{ $message }}
                        </p>
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
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <x-heroicon-o-exclamation-circle class="w-4 h-4 mr-1"/> {{ $message }}
                        </p>
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
                        <p class="text-red-600 text-sm mt-1 flex items-center">
                            <x-heroicon-o-exclamation-circle class="w-4 h-4 mr-1"/> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('dependencias.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        <x-heroicon-o-x-mark class="w-5 h-5 mr-1"/> Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        <x-heroicon-o-check class="w-5 h-5 mr-1"/> Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>


