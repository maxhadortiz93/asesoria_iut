<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organismos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    @include('layouts.head')

    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center space-x-2">
                <x-heroicon-o-building-library class="w-7 h-7 text-blue-600"/>
                <span>Organismos</span>
            </h1>
        </div>

        {{-- Mensajes flash --}}
        @if(session('status'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 p-4 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- Formulario para crear un nuevo organismo --}}
        <div class="mb-6 bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
            <form action="{{ route('organismos.store') }}" method="POST" class="flex flex-wrap gap-4 items-end">
                @csrf
                <div class="flex-1 min-w-[150px]">
                    <label for="codigo" class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                    <input type="text" name="codigo" id="codigo" required
                           class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required
                           class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                    <x-heroicon-o-plus class="w-5 h-5 mr-1"/> Agregar
                </button>
            </form>
        </div>

        {{-- Tabla de organismos --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($organismos as $organismo)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-mono">{{ $organismo->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $organismo->codigo }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $organismo->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('organismos.show', $organismo) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 bg-yellow-50 rounded hover:bg-yellow-100">
                                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1"/> Editar
                                    </a>
                                    <form action="{{ route('organismos.destroy', $organismo) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar este organismo?')"
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">
                                            <x-heroicon-o-trash class="w-4 h-4 mr-1"/> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hay organismos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $organismos->links() }}
            </div>
        </div>
    </main>

</body>
</html>


