<nav class="bg-blue-600 text-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 text-xl font-bold">
                🏢 Inventario
            </div>

            <!-- Links -->
            <div class="hidden md:flex space-x-1">
                <a href="{{ url('/') }}" class="px-3 py-2 rounded hover:bg-blue-500">Inicio</a>
                <a href="{{ route('organismos.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Organismos</a>
                <a href="{{ route('bienes.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Bienes</a>
                <a href="{{ route('unidades.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Unidades</a>
                <a href="{{ route('dependencias.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Dependencias</a>
                <a href="{{ route('usuarios.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Usuarios</a>
            </div>

            <!-- Logout -->
            <div>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</nav>


