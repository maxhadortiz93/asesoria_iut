<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Unidad Administradora</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    @include('layouts.head')

    <!-- Contenido principal -->
    <main class="max-w-3xl mx-auto py-10 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Registrar nueva Unidad Administradora</h2>

            <form action="{{ route('unidades.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Organismo -->
                <div>
                    <label for="organismo_id" class="block text-sm font-medium text-gray-700">Organismo</label>
                    <select name="organismo_id" id="organismo_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                   focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Seleccione...</option>
                        @foreach($organismos as $org)
                            <option value="{{ $org->id }}" {{ old('organismo_id') == $org->id ? 'selected' : '' }}>
                                {{ $org->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('organismo_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código -->
                <div>
                    <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('codigo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('unidades.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
