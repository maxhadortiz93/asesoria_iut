<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organismos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    @include('layouts.head')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <!-- contenido de la página -->
    </main>

</body>

<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">

    <div class="w-full max-w-4xl bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📋 Lista de Organismos</h1>

        {{-- Formulario para crear un nuevo organismo --}}
        <form action="{{ route('organismos.store') }}" method="POST" class="mb-6 flex gap-4">
            @csrf
            <input type="text" name="codigo" placeholder="Código"
                   class="border rounded px-3 py-2 w-1/4" required>
            <input type="text" name="nombre" placeholder="Nombre"
                   class="border rounded px-3 py-2 flex-1" required>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                ➕ Agregar
            </button>
        </form>

        {{-- Tabla de organismos --}}
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Código</th>
                    <th class="p-3 border">Nombre</th>
                    <th class="p-3 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organismos as $organismo)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border">{{ $organismo->id }}</td>
                        <td class="p-3 border">{{ $organismo->codigo }}</td>
                        <td class="p-3 border">{{ $organismo->nombre }}</td>
                        <td class="p-3 border flex gap-2">
                            {{-- Editar --}}
                            <a href="{{ route('organismos.show', $organismo) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                ✏️ Editar
                            </a>
                            {{-- Eliminar --}}
                            <form action="{{ route('organismos.destroy', $organismo) }}" method="POST"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este organismo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">No hay organismos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $organismos->links() }}
        </div>
    </div>

</body>
</html>

