<nav class="bg-blue-600 text-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 text-xl font-bold">
                🏢 Inventario
            </div>

            <!-- Links -->
            <div class="hidden md:flex space-x-1 items-center">
                <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('usuarios.index') : route('bienes.index')) : route('login') }}" class="px-3 py-2 rounded hover:bg-blue-500">Inicio</a>
                <a href="{{ route('organismos.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Organismos</a>
                <a href="{{ route('bienes.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Bienes</a>
                <a href="{{ route('unidades.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Unidades</a>
                <a href="{{ route('dependencias.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Dependencias</a>
                <a href="{{ route('usuarios.index') }}" class="px-3 py-2 rounded hover:bg-blue-500">Usuarios</a>
            </div>

            <!-- User and Logout -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="text-sm text-blue-100">
                        <span class="font-semibold">{{ auth()->user()->nombre_completo ?? auth()->user()->nombre }}</span>
                        @if(auth()->user()->isAdmin())
                            <span class="ml-2 inline-flex px-2 py-0.5 text-xs font-semibold text-purple-100 bg-purple-600/40 rounded-full">Administrador</span>
                        @else
                            <span class="ml-2 inline-flex px-2 py-0.5 text-xs font-semibold text-blue-100 bg-blue-600/40 rounded-full">Usuario</span>
                        @endif
                    </div>
                @endauth
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</nav>


