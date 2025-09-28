<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficina de Bienes Nacionales</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar opcional --}}
    @include('layouts.head')

    <!-- Portada -->
    <section class="bg-blue-700 text-white py-16 text-center">
        <h1 class="text-4xl font-bold mb-4">Oficina de Bienes Nacionales</h1>
        <p class="max-w-3xl mx-auto text-lg">
            La Oficina de Bienes Nacionales es una unidad esencial en la estructura de la universidad,
            ya que actúa como el custodio y administrador principal de todo el patrimonio institucional.
            Su rol es asegurar el control completo y eficiente de todos los recursos muebles e inmuebles,
            apoyando la planificación administrativa y salvaguardando el uso exclusivo de estos bienes
            para los fines de la institución.
        </p>
    </section>

    <!-- Contenido principal en 4 cuadros -->
    <main class="max-w-6xl mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Misión -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-blue-700 mb-4">Misión</h2>
            <p class="text-gray-700 leading-relaxed">
                Nuestra misión es administrar y gestionar los bienes muebles e inmuebles propiedad de la universidad
                con un enfoque de eficiencia, transparencia y responsabilidad. Esto implica un control integral que
                abarca desde el registro, la asignación y el uso hasta la desincorporación y disposición final de los
                activos, todo en estricto cumplimiento del marco legal y normativo vigente.
            </p>
        </div>

        <!-- Visión -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-blue-700 mb-4">Visión</h2>
            <p class="text-gray-700 leading-relaxed">
                Aspiramos a ser la unidad líder y centralizada en la gestión patrimonial de la universidad,
                reconocida por la excelencia y la modernización de sus procesos. Visualizamos la implementación
                de sistemas de información automatizados que nos permitan mantener un registro digital confiable
                y alcanzar la trazabilidad total de cada activo.
            </p>
        </div>

        <!-- Funciones Clave (parte 1) -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-blue-700 mb-4">Funciones Clave</h2>
            <p class="text-gray-700 leading-relaxed">
                La Oficina de Bienes Nacionales ejecuta funciones esenciales como el mantenimiento y actualización
                constante del inventario institucional, incluyendo el registro de las altas (adquisiciones),
                transferencias y bajas (desincorporaciones) de los bienes.
            </p>
        </div>

        <!-- Funciones Clave (parte 2) -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-blue-700 mb-4">Gestión y Control</h2>
            <p class="text-gray-700 leading-relaxed">
                Realiza inspecciones y recuentos físicos periódicos para verificar la existencia, ubicación y estado
                de conservación de los activos. Además, genera reportes y estadísticas para auditorías y coordina
                políticas de mantenimiento preventivo y correctivo que aseguren la durabilidad y buen uso de los bienes.
            </p>
        </div>

    </main>

</body>
</html>





