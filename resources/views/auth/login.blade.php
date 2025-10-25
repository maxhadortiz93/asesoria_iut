<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}


    <!-- Contenido principal -->
    <main class="max-w-md mx-auto px-4 py-16">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center space-x-2">
                <x-heroicon-o-lock-closed class="w-6 h-6 text-blue-600"/>
                <span>Iniciar Sesión</span>
            </h1>

            {{-- Mensaje de error --}}
            @if(session('error'))
                <div class="mb-4 rounded-md bg-red-100 border border-red-300 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input type="email" name="correo" id="correo" value="{{ old('correo') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           required autofocus>
                    @error('correo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           required>
                    @error('password')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>

                <div>
                    <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 mr-2"/>
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
