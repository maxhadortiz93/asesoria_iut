<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidades Administradoras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    @include('layouts.head')

    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center space-x-2">
                <x-heroicon-o-building-office class="w-7 h-7 text-blue-600"/>
                <span>Unidades Administradoras</span>
            </h1>
            <a href="{{ route('unidades.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                <x-heroicon-o-plus class="w-5 h-5 mr-1"/>
                Nueva Unidad
            </a>
        </div>

        {{-- Mensajes flash --}}
        @if(session('status'))
            <div class="mb-4 rounded-md bg-green-100 border border-green-300 p-4 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- Tabla de unidades --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organismo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dependencias</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($unidades as $unidad)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-mono">{{ $unidad->codigo }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $unidad->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $unidad->organismo->nombre ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($unidad->dependencias->count())
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach($unidad->dependencias as $dep)
                                                <li>{{ $dep->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('unidades.show', $unidad) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 bg-blue-50 rounded hover:bg-blue-100">
                                        <x-heroicon-o-eye class="w-4 h-4 mr-1"/> Ver
                                    </a>
                                    <a href="{{ route('unidades.edit', $unidad) }}"
                                       class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 bg-yellow-50 rounded hover:bg-yellow-100">
                                        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1"/> Editar
                                    </a>
                                    <form action="{{ route('unidades.destroy', $unidad) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta unidad?')"
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 bg-red-50 rounded hover:bg-red-100">
                                            <x-heroicon-o-trash class="w-4 h-4 mr-1"/> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hay unidades registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $unidades->links() }}
            </div>
        </div>
    </main>

</body>
</html>

