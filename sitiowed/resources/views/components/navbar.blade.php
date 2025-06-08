<nav class="bg-white p-4 shadow-md rounded-lg flex items-center justify-between flex-wrap">
    <!-- Logo o Nombre de la Aplicación -->
    <div class="flex items-center flex-shrink-0 text-gray-800 mr-6">
        <svg class="h-8 w-8 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <span class="font-bold text-xl tracking-tight">Registro de Estudiantes</span>
    </div>

    <!-- Contenedor de Enlaces de Navegación (visible en desktop, oculto en móvil por defecto) -->
    <div class="hidden md:flex items-center space-x-6">
        <a href="{{ route('dashboard') }}" class="block text-gray-600 hover:text-indigo-600 font-medium py-2 px-3 rounded-md transition-colors duration-200">
            Dashboard
        </a>
        <a href="{{ route('carreras.index') }}" class="block text-gray-600 hover:text-indigo-600 font-medium py-2 px-3 rounded-md transition-colors duration-200">
            Carreras
        </a>
        <a href="{{ route('estudiantes.index') }}" class="block text-gray-600 hover:text-indigo-600 font-medium py-2 px-3 rounded-md transition-colors duration-200">
            Estudiantes
        </a>
    </div>

    <!-- Botón de Menú para Móviles (para implementar un menú hamburguesa si es necesario) -->
    <div class="block md:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-gray-800">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v15z"/></svg>
        </button>
    </div>

    <!-- Enlaces de Usuario (derecha) -->
    <div class="flex items-center space-x-4 ml-auto">
        <!-- Puedes añadir un nombre de usuario o avatar aquí -->
        <span class="text-gray-700 font-medium hidden sm:block">Hola, {{ $user->name ?? 'Usuario' }}!</span>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="bg-red-500 text-white py-2 px-4 rounded-md font-semibold hover:bg-red-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>