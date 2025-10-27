@extends('layouts.base')

@section('title', 'Crear Usuario')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nuevo Usuario</h1>
        
        @if(!auth()->user()->isAdmin())
            <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded">
                <p class="text-sm">Solo puedes crear usuarios normales. Para crear administradores, contacta a un administrador existente.</p>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="cedula" class="block text-sm font-medium text-gray-700">Cédula (Formato: V-XX.XXX.XXX)</label>
                <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="V-12.345.678"
                       maxlength="20"
                       required>
                <p class="text-xs text-gray-500 mt-1">Debe comenzar con V-, seguido de números separados por puntos</p>
                @error('cedula')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <p id="cedula-error" class="text-sm text-red-600 mt-1" style="display:none;"></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                           class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Ej: Juan"
                           required>
                    <p id="nombre-error" class="text-sm text-red-600 mt-1" style="display:none;"></p>
                    @error('nombre')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" 
                           class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Ej: Pérez"
                           required>
                    <p id="apellido-error" class="text-sm text-red-600 mt-1" style="display:none;"></p>
                    @error('apellido')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" id="correo" value="{{ old('correo') }}" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="usuario@ejemplo.com"
                       required>
                <p id="correo-error" class="text-sm text-red-600 mt-1" style="display:none;"></p>
                @error('correo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo rol_id oculto - se establece desde los permisos -->
            <input type="hidden" name="rol_id" id="rol_id" value="2">

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña (mínimo 8 caracteres)</label>
                <input type="password" name="hash_password" id="password" 
                       class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       placeholder="••••••••"
                       required>
                <p id="password-error" class="text-sm text-red-600 mt-1" style="display:none;"></p>
                @error('hash_password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if(auth()->user()->isAdmin())
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Permisos del Usuario</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <input type="radio" name="user_type" id="user_type_admin" value="admin" 
                                   class="rounded-full border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 mt-1"
                                   {{ old('user_type') === 'admin' ? 'checked' : '' }}>
                            <label for="user_type_admin" class="ml-3 block text-sm font-medium text-gray-700">
                                <span class="font-semibold">Usuario Administrador</span>
                                <p class="text-xs text-gray-600 font-normal mt-1">Puede gestionar usuarios y crear otros administradores. Tiene permisos totales del sistema.</p>
                            </label>
                        </div>
                        <div class="flex items-start">
                            <input type="radio" name="user_type" id="user_type_normal" value="normal" 
                                   class="rounded-full border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 mt-1"
                                   {{ old('user_type') !== 'admin' ? 'checked' : '' }}>
                            <label for="user_type_normal" class="ml-3 block text-sm font-medium text-gray-700">
                                <span class="font-semibold">Usuario Normal</span>
                                <p class="text-xs text-gray-600 font-normal mt-1">Puede crear organismos, unidades, dependencias, bienes y movimientos. Sin permisos de gestión de usuarios.</p>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Campo oculto para enviar is_admin -->
                <input type="hidden" name="is_admin" id="is_admin" value="1">
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Activo</label>
                <div class="flex items-center">
                    <input type="checkbox" name="activo" id="activo" value="1" 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           {{ old('activo', true) ? 'checked' : '' }}>
                    <label for="activo" class="ml-2 block text-sm text-gray-700">
                        Usuario activo
                    </label>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" id="guardar-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Guardar
                </button>
                <a href="{{ route('usuarios.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Resultado -->
<div id="resultado-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <!-- Encabezado -->
        <div id="modal-header" class="px-6 py-4 border-b">
            <h2 id="modal-title" class="text-xl font-bold"></h2>
        </div>
        
        <!-- Contenido -->
        <div class="px-6 py-4">
            <div class="flex items-start gap-4">
                <div id="modal-icon" class="text-4xl flex-shrink-0"></div>
                <div>
                    <p id="modal-message" class="text-gray-700 text-sm"></p>
                    <p id="modal-details" class="text-gray-600 text-xs mt-2" style="display: none;"></p>
                </div>
            </div>
        </div>
        
        <!-- Botones -->
        <div class="px-6 py-4 border-t flex gap-3 justify-end">
            <button id="modal-close-btn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400" onclick="cerrarModal()">
                Cerrar
            </button>
            <button id="modal-redirect-btn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" onclick="redirigirAListar()" style="display: none;">
                Ir a Usuarios
            </button>
        </div>
    </div>
</div>

@endsection

<script>
    const cedulaInput = document.getElementById('cedula');
    const cedulaError = document.getElementById('cedula-error');

    cedulaInput.addEventListener('input', function(e) {
        let value = e.target.value.toUpperCase();
        
        // Remover caracteres que no sean V, - y números
        value = value.replace(/[^V0-9\-]/g, '');
        
        // Si comienza con V, procesarlo con el formato correcto
        if (value.startsWith('V')) {
            // Extraer solo los números después de V
            const numbers = value.substring(1).replace(/[^0-9]/g, '');
            
            if (numbers.length === 0) {
                value = 'V-';
            } else if (numbers.length <= 2) {
                value = 'V-' + numbers;
            } else if (numbers.length <= 5) {
                value = 'V-' + numbers.substring(0, 2) + '.' + numbers.substring(2);
            } else if (numbers.length <= 8) {
                value = 'V-' + numbers.substring(0, 2) + '.' + numbers.substring(2, 5) + '.' + numbers.substring(5);
            } else {
                // Máximo 8 dígitos
                value = 'V-' + numbers.substring(0, 2) + '.' + numbers.substring(2, 5) + '.' + numbers.substring(5, 8);
            }
        } else {
            value = 'V-';
        }
        
        e.target.value = value;
        validarCedula(value);
    });

    cedulaInput.addEventListener('blur', function(e) {
        validarCedula(e.target.value);
    });

    function validarCedula(cedula) {
        const regex = /^V-\d{2}\.\d{3}\.\d{3}$/;
        
        if (cedula.trim() === '' || cedula === 'V-') {
            cedulaError.textContent = '';
            cedulaError.style.display = 'none';
            return true;
        }
        
        if (!regex.test(cedula)) {
            cedulaError.textContent = 'Formato inválido. Debe ser: V-XX.XXX.XXX';
            cedulaError.style.display = 'block';
            return false;
        }
        
        cedulaError.textContent = '';
        cedulaError.style.display = 'none';
        return true;
    }

    // Validar al enviar el formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const cedula = cedulaInput.value;
        if (!validarCedula(cedula)) {
            e.preventDefault();
            cedulaInput.focus();
        }
    });

    // Manejar selección de tipo de usuario (solo visible para admins)
    const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
    const isAdminInput = document.getElementById('is_admin');
    const rolIdInput = document.getElementById('rol_id');

    userTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'admin') {
                // Usuario Administrador
                isAdminInput.value = '1';
                rolIdInput.value = '1'; // ID del rol Administrador
            } else if (this.value === 'normal') {
                // Usuario Normal (Data Entry)
                isAdminInput.value = '0';
                rolIdInput.value = '2'; // ID del rol Usuario Normal
            }
        });
    });

    // Inicializar el valor según selección inicial
    const selectedUserType = document.querySelector('input[name="user_type"]:checked');
    if (selectedUserType && isAdminInput) {
        if (selectedUserType.value === 'admin') {
            isAdminInput.value = '1';
            rolIdInput.value = '1';
        } else if (selectedUserType.value === 'normal') {
            isAdminInput.value = '0';
            rolIdInput.value = '2';
        }
    }

    // Elementos de entrada
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const correoInput = document.getElementById('correo');
    const passwordInput = document.getElementById('password');
    const guardarBtn = document.getElementById('guardar-btn');

    // Elementos de error
    const cedulaErrorEl = document.getElementById('cedula-error');
    const nombreErrorEl = document.getElementById('nombre-error');
    const apellidoErrorEl = document.getElementById('apellido-error');
    const correoErrorEl = document.getElementById('correo-error');
    const passwordErrorEl = document.getElementById('password-error');

    // Funciones de validación individual
    function validarNombre() {
        const nombre = nombreInput.value.trim();
        const valido = nombre.length > 0;
        if (!valido && nombreInput.value !== '') {
            nombreErrorEl.textContent = 'El nombre es requerido';
            nombreErrorEl.style.display = 'block';
        } else {
            nombreErrorEl.style.display = 'none';
        }
        return valido;
    }

    function validarApellido() {
        const apellido = apellidoInput.value.trim();
        const valido = apellido.length > 0;
        if (!valido && apellidoInput.value !== '') {
            apellidoErrorEl.textContent = 'El apellido es requerido';
            apellidoErrorEl.style.display = 'block';
        } else {
            apellidoErrorEl.style.display = 'none';
        }
        return valido;
    }

    function validarCorreo() {
        const correo = correoInput.value.trim();
        const esValido = correoInput.checkValidity() && correo.length > 0;
        
        if (correo.length > 0 && !esValido) {
            correoErrorEl.textContent = 'Correo inválido. Usa formato: usuario@ejemplo.com';
            correoErrorEl.style.display = 'block';
        } else {
            correoErrorEl.style.display = 'none';
        }
        return esValido;
    }

    function validarPassword() {
        const password = passwordInput.value;
        const esValido = password.length >= 8;
        
        if (password.length > 0 && !esValido) {
            passwordErrorEl.textContent = `La contraseña debe tener al menos 8 caracteres (${password.length}/8)`;
            passwordErrorEl.style.display = 'block';
        } else {
            passwordErrorEl.style.display = 'none';
        }
        return esValido;
    }

    // Eventos para validación en tiempo real
    nombreInput.addEventListener('input', validarNombre);
    nombreInput.addEventListener('blur', validarNombre);

    apellidoInput.addEventListener('input', validarApellido);
    apellidoInput.addEventListener('blur', validarApellido);

    correoInput.addEventListener('input', validarCorreo);
    correoInput.addEventListener('blur', validarCorreo);

    passwordInput.addEventListener('input', validarPassword);
    passwordInput.addEventListener('blur', validarPassword);

    cedulaInput.addEventListener('input', function() {
        if (cedulaInput.value.trim() !== '' && !cedulaErrorEl) {
            validarCedula(cedulaInput.value);
        }
    });
    cedulaInput.addEventListener('blur', function() {
        validarCedula(cedulaInput.value);
    });

    // Envío del formulario
    document.querySelector('form').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validar todos los campos
        const cedula = cedulaInput.value.trim();
        const nombre = nombreInput.value.trim();
        const apellido = apellidoInput.value.trim();
        const correo = correoInput.value.trim();
        const password = passwordInput.value;

        // Mostrar errores si existen
        let erroresEncontrados = [];

        if (!cedula || cedula === 'V-') {
            cedulaErrorEl.textContent = 'La cédula es requerida';
            cedulaErrorEl.style.display = 'block';
            erroresEncontrados.push('cedula');
        } else if (!/^V-\d{2}\.\d{3}\.\d{3}$/.test(cedula)) {
            cedulaErrorEl.textContent = 'Formato de cédula inválido. Debe ser: V-XX.XXX.XXX';
            cedulaErrorEl.style.display = 'block';
            erroresEncontrados.push('cedula');
        } else {
            cedulaErrorEl.style.display = 'none';
        }

        if (!nombre) {
            nombreErrorEl.textContent = 'El nombre es requerido';
            nombreErrorEl.style.display = 'block';
            erroresEncontrados.push('nombre');
        } else {
            nombreErrorEl.style.display = 'none';
        }

        if (!apellido) {
            apellidoErrorEl.textContent = 'El apellido es requerido';
            apellidoErrorEl.style.display = 'block';
            erroresEncontrados.push('apellido');
        } else {
            apellidoErrorEl.style.display = 'none';
        }

        if (!correo) {
            correoErrorEl.textContent = 'El correo es requerido';
            correoErrorEl.style.display = 'block';
            erroresEncontrados.push('correo');
        } else if (!correoInput.checkValidity()) {
            correoErrorEl.textContent = 'Correo inválido. Usa formato: usuario@ejemplo.com';
            correoErrorEl.style.display = 'block';
            erroresEncontrados.push('correo');
        } else {
            correoErrorEl.style.display = 'none';
        }

        if (!password) {
            passwordErrorEl.textContent = 'La contraseña es requerida';
            passwordErrorEl.style.display = 'block';
            erroresEncontrados.push('password');
        } else if (password.length < 8) {
            passwordErrorEl.textContent = `La contraseña debe tener al menos 8 caracteres (${password.length}/8)`;
            passwordErrorEl.style.display = 'block';
            erroresEncontrados.push('password');
        } else {
            passwordErrorEl.style.display = 'none';
        }

        // Si hay errores, mostrar modal y no enviar
        if (erroresEncontrados.length > 0) {
            mostrarModal('error', '⚠ Errores en el Formulario', 'Por favor corrige los errores en rojo e intenta de nuevo.');
            // Enfocar el primer campo con error
            if (erroresEncontrados[0] === 'cedula') cedulaInput.focus();
            else if (erroresEncontrados[0] === 'nombre') nombreInput.focus();
            else if (erroresEncontrados[0] === 'apellido') apellidoInput.focus();
            else if (erroresEncontrados[0] === 'correo') correoInput.focus();
            else if (erroresEncontrados[0] === 'password') passwordInput.focus();
            return;
        }

        // Si todo está bien, mostrar modal de carga y enviar
        mostrarModal('loading', 'Procesando...', 'Por favor espera mientras registramos al usuario.');

        try {
            const formData = new FormData(this);
            const response = await fetch('{{ route("usuarios.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.ok) {
                mostrarModal('success', '✓ Éxito', 'El usuario ha sido registrado correctamente.');
                guardarBtn.disabled = true;
                setTimeout(() => {
                    redirigirAListar();
                }, 2000);
            } else if (response.status === 422) {
                // Error de validación
                const errors = await response.json();
                let errorMsg = 'Error en los datos ingresados:\n';
                
                if (errors.errors.cedula) {
                    errorMsg = errors.errors.cedula[0];
                } else if (errors.errors.correo) {
                    errorMsg = errors.errors.correo[0];
                } else {
                    errorMsg = Object.values(errors.errors).flat()[0];
                }

                mostrarModal('error', '⚠ Error de Validación', errorMsg);
            } else if (response.status === 403) {
                const data = await response.json();
                mostrarModal('error', '🔒 Permiso Denegado', data.message || 'No tienes permisos para realizar esta acción.');
            } else {
                mostrarModal('error', '❌ Error', 'Ocurrió un error al registrar el usuario. Intenta de nuevo.');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarModal('error', '❌ Error de Red', 'Hubo un problema al conectarse con el servidor.');
        }
    });

    function mostrarModal(tipo, titulo, mensaje) {
        const modal = document.getElementById('resultado-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalIcon = document.getElementById('modal-icon');
        const modalMessage = document.getElementById('modal-message');
        const modalHeader = document.getElementById('modal-header');
        const closeBtn = document.getElementById('modal-close-btn');
        const redirectBtn = document.getElementById('modal-redirect-btn');

        modalTitle.textContent = titulo;
        modalMessage.textContent = mensaje;

        // Estilos según tipo
        if (tipo === 'success') {
            modalIcon.textContent = '✓';
            modalIcon.className = 'text-4xl flex-shrink-0 text-green-500 font-bold';
            modalHeader.className = 'px-6 py-4 border-b bg-green-50';
            modalTitle.className = 'text-xl font-bold text-green-700';
            closeBtn.style.display = 'none';
            redirectBtn.style.display = 'inline-block';
        } else if (tipo === 'error') {
            modalIcon.textContent = '✕';
            modalIcon.className = 'text-4xl flex-shrink-0 text-red-500 font-bold';
            modalHeader.className = 'px-6 py-4 border-b bg-red-50';
            modalTitle.className = 'text-xl font-bold text-red-700';
            closeBtn.style.display = 'inline-block';
            redirectBtn.style.display = 'none';
        } else if (tipo === 'loading') {
            modalIcon.textContent = '⏳';
            modalIcon.className = 'text-4xl flex-shrink-0 text-blue-500';
            modalHeader.className = 'px-6 py-4 border-b bg-blue-50';
            modalTitle.className = 'text-xl font-bold text-blue-700';
            closeBtn.style.display = 'none';
            redirectBtn.style.display = 'none';
        }

        modal.style.display = 'flex';
    }

    function cerrarModal() {
        document.getElementById('resultado-modal').style.display = 'none';
    }

    function redirigirAListar() {
        window.location.href = '{{ route("usuarios.index") }}';
    }

    // Validar formulario al cargar
    validarFormulario();
</script>
