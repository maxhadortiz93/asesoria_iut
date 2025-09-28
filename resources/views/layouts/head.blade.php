<nav class="bg-blue-600 text-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex-shrink-0 text-xl font-bold flex items-center space-x-2">
                🚀 <span>Mi Proyecto</span>
            </div>

            <!-- Links -->
            <div class="hidden md:flex space-x-6 items-center">

                <!-- Inicio -->
                <a href="{{ url('/') }}" class="hover:text-gray-200 flex items-center space-x-2">
                    <x-heroicon-o-home class="w-5 h-5"/>
                    <span>Inicio</span>
                </a>

                <!-- Organismos -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center space-x-2 focus:outline-none">
                        <x-heroicon-o-building-office class="w-5 h-5"/>
                        <span>Organismos</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 transform group-hover:rotate-180 transition"/>
                    </button>
                    <div class="absolute hidden group-hover:block group-focus-within:block bg-white text-gray-800 mt-2 rounded-md shadow-lg w-44 z-50">
                        <a href="{{ route('organismos.index') }}" class="block px-4 py-2 hover:bg-gray-100">Listado</a>
                        <a href="{{ route('organismos.create') }}" class="block px-4 py-2 hover:bg-gray-100">Nuevo Organismo</a>
                    </div>
                </div>

                <!-- Bienes -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center space-x-2 focus:outline-none">
                        <x-heroicon-o-archive-box class="w-5 h-5"/>
                        <span>Bienes</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 transform group-hover:rotate-180 transition"/>
                    </button>
                    <div class="absolute hidden group-hover:block group-focus-within:block bg-white text-gray-800 mt-2 rounded-md shadow-lg w-44 z-50">
                        <a href="{{ route('bienes.index') }}" class="block px-4 py-2 hover:bg-gray-100">Listado</a>
                        <a href="{{ route('bienes.create') }}" class="block px-4 py-2 hover:bg-gray-100">Nuevo Bien</a>
                    </div>
                </div>

                <!-- Unidades -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center space-x-2 focus:outline-none">
                        <x-heroicon-o-building-library class="w-5 h-5"/>
                        <span>Unidades</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 transform group-hover:rotate-180 transition"/>
                    </button>
                    <div class="absolute hidden group-hover:block group-focus-within:block bg-white text-gray-800 mt-2 rounded-md shadow-lg w-44 z-50">
                        <a href="{{ route('unidades.index') }}" class="block px-4 py-2 hover:bg-gray-100">Listado</a>
                        <a href="{{ route('unidades.create') }}" class="block px-4 py-2 hover:bg-gray-100">Nueva Unidad</a>
                    </div>
                </div>

                <!-- Dependencias -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center space-x-2 focus:outline-none">
                        <x-heroicon-o-link class="w-5 h-5"/>
                        <span>Dependencias</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 transform group-hover:rotate-180 transition"/>
                    </button>
                    <div class="absolute hidden group-hover:block group-focus-within:block bg-white text-gray-800 mt-2 rounded-md shadow-lg w-48 z-50">
                        <a href="{{ route('dependencias.index') }}" class="block px-4 py-2 hover:bg-gray-100">Listado</a>
                        <a href="{{ route('dependencias.create') }}" class="block px-4 py-2 hover:bg-gray-100">Nueva Dependencia</a>
                    </div>
                </div>

                <!-- Usuarios -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center space-x-2 focus:outline-none">
                        <x-heroicon-o-user class="w-5 h-5"/>
                        <span>Usuarios</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 transform group-hover:rotate-180 transition"/>
                    </button>
                    <div class="absolute hidden group-hover:block group-focus-within:block bg-white text-gray-800 mt-2 rounded-md shadow-lg w-44 z-50">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Listado</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Nuevo Usuario</a>
                    </div>
                </div>

                <!-- Reportes -->
                <div class="relative group">
                    <button class="hover:text-gray-200 flex items-center space-x-2 focus:outline-none">
                        <x-heroicon-o-chart-bar class="w-5 h-5"/>
                        <span>Reportes</span>
                        <x-heroicon-o-chevron-down class="w-4 h-4 transform group-hover:rotate-180 transition"/>
                    </button>
                    <div class="absolute hidden group-hover:block group-focus-within:block bg-white text-gray-800 mt-2 rounded-md shadow-lg w-44 z-50">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Generar Reporte</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Historial</a>
                    </div>
                </div>
            </div>

            <!-- Botón de login -->
            <div>
                <a href="#"
                   class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Ingresar
                </a>
            </div>
        </div>
    </div>
</nav>



