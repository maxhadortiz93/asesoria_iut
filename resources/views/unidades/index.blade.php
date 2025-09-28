<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidades Administradoras</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
   <body class="bg-gray-100 min-h-screen">

    @include('layouts.head')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <!-- contenido de la página -->
    </main>

</body>


    <!-- Contenido principal -->
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Unidades Administradoras</h1>
            <a href="{{ route('unidades.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                + Nueva Unidad
            </a>
        </div>

        @if(session('status'))
            <div class="mb-4 rounded-md bg-green-50 p-4 text-green-700">
                {{ session('status') }}
            </div>
        @endif

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
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $unidad->codigo }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $unidad->nombre }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $unidad->organismo->nombre ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if($unidad->dependencias->count())
                                        <ul class="list-disc list-inside text-gray-600">
                                            @foreach($unidad->dependencias as $dep)
                                                <li>{{ $dep->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('unidades.show', $unidad) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                    <a href="{{ route('unidades.edit', $unidad) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                    <form action="{{ route('unidades.destroy', $unidad) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta unidad?')"
                                                class="text-red-600 hover:text-red-900">
                                            Eliminar
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

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $unidades->links() }}
            </div>
        </div>
    </main>

</body>
</html>
