<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    @include('layouts.head')

    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center space-x-2">
                <x-heroicon-o-cube class="w-7 h-7 text-blue-600"/>
                <span>Bienes</span>
            </h1>
            <a href="{{ route('bienes.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                <x-heroicon-o-plus class="w-5 h-5 mr-1"/>
                Nuevo Bien
            </a>
        </div>

        {{-- Mensajes flash --}}
        @if(session('status'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 p-4 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- Tabla --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dependencia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Responsable</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ubicación</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Registro</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bienes as $bien)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-mono">{{ $bien->codigo }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $bien->descripcion }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $bien->dependencia->nombre ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $bien->responsable->nombre ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $bien->estado->value === 'activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($bien->estado->value) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $bien->ubicacion ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ optional($bien->fecha_registro)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('bienes.show', $bien) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded hover:bg-blue-100">
                                        <x-heroicon-o-eye class="w-4 h-4 mr-1"/> Ver
                                    </a>
                                    <a href="{{ route('bienes.edit', $bien) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 bg-yellow-50 rounded hover:bg-yellow-100">
                                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1"/> Editar
                                    </a>
                                    <form action="{{ route('bienes.destroy', $bien) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar este bien?')"
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">
                                            <x-heroicon-o-trash class="w-4 h-4 mr-1"/> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hay bienes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bienes->links() }}
            </div>
        </div>
    </main>

</body>
</html>



