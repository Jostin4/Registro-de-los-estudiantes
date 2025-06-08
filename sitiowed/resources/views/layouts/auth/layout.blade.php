<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Autenticación') - Tu Aplicación</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Degradado de fondo */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        /* No se requiere .form-container aquí ya que los formularios específicos estarán en las vistas hijas */
    </style>
    @yield('styles') {{-- Para estilos adicionales específicos de la vista hija --}}
</head>
<body>
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md border border-gray-200">
        <!-- Contenedor principal de la tarjeta de autenticación -->
        <div class="flex justify-center mb-6">
            <!-- Pestañas para alternar entre Login y Registro -->
            <!-- Estos botones ahora navegarán a las rutas correspondientes -->
            <a href="{{ route('loginView') }}" id="tab-login" class="px-6 py-2 rounded-md font-medium text-lg focus:outline-none transition-colors duration-300 mr-2
                @if(Route::currentRouteName() === 'loginView') bg-indigo-600 text-white shadow-md @else text-indigo-700 bg-gray-100 hover:bg-gray-200 @endif">
                Iniciar Sesión
            </a>
            <a href="{{ route('registerView') }}" id="tab-register" class="px-6 py-2 rounded-md font-medium text-lg focus:outline-none transition-colors duration-300
                @if(Route::currentRouteName() === 'registerView') bg-indigo-600 text-white shadow-md @else text-indigo-700 bg-gray-100 hover:bg-gray-200 @endif">
                Registrarse
            </a>
        </div>

        {{-- Aquí se inyectará el contenido del formulario de login o registro --}}
        @yield('form_content')
    </div>

    @yield('scripts') {{-- Para scripts adicionales específicos de la vista hija --}}

    <script>
        // Este script es solo para simular el comportamiento si no se usa Livewire/Vue,
        // ya que con rutas separadas, el navegador se encargará de la navegación.
        // Si necesitas un toggle en la misma página, la lógica sería más compleja
        // y probablemente implicaría Livewire o un framework JS.
        // Para Blade puro y rutas separadas, los enlaces de arriba son suficientes.

        // Ejemplo: Si quieres resaltar el botón activo en la navegación después de la carga
        document.addEventListener('DOMContentLoaded', function() {
            const loginTab = document.getElementById('tab-login');
            const registerTab = document.getElementById('tab-register');
            const currentPath = window.location.pathname;

            if (currentPath.includes('/loginView')) {
                loginTab.classList.add('bg-indigo-600', 'text-white', 'shadow-md');
                loginTab.classList.remove('text-indigo-700', 'bg-gray-100', 'hover:bg-gray-200');
                registerTab.classList.remove('bg-indigo-600', 'text-white', 'shadow-md');
                registerTab.classList.add('text-indigo-700', 'bg-gray-100', 'hover:bg-gray-200');
            } else if (currentPath.includes('/registerView')) {
                registerTab.classList.add('bg-indigo-600', 'text-white', 'shadow-md');
                registerTab.classList.remove('text-indigo-700', 'bg-gray-100', 'hover:bg-gray-200');
                loginTab.classList.remove('bg-indigo-600', 'text-white', 'shadow-md');
                loginTab.classList.add('text-indigo-700', 'bg-gray-100', 'hover:bg-gray-200');
            }
        });
    </script>
</body>
</html>
