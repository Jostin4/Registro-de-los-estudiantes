<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Dashboard') - Tu Aplicación</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Fondo degradado en todo el body */
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Organiza los elementos en columna (header, main, footer) */
            margin: 0;
            box-sizing: border-box;
            color: #333; /* Color de texto base */
        }
        main {
            flex-grow: 1; /* Permite que el contenido principal ocupe el espacio restante */
            padding: 1.5rem; /* Espaciado alrededor del contenido */
            max-width: 1200px; /* Ancho máximo para el contenido para legibilidad */
            width: 100%; /* Asegura que ocupe el ancho disponible */
            margin: 0 auto; /* Centra el contenido principal */
        }
        .navbar-placeholder {
            background-color: #ffffff; /* Fondo blanco para la barra de navegación */
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            width: 100%; /* Cubre todo el ancho */
        }
        .footer-placeholder {
            background-color: #1a202c; /* Un gris oscuro para el pie de página */
            color: #e2e8f0;
            padding: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            width: 100%; /* Cubre todo el ancho */
        }
    </style>
    @stack('styles') {{-- Para estilos CSS adicionales que las vistas hijas puedan añadir --}}
</head>
<body>
    <header class="navbar-placeholder">
       <x-navbar />
    </header>
    <main>
        @yield('content') {{-- Aquí se insertará el contenido específico de cada vista del dashboard --}}
    </main>
    <footer class="footer-placeholder">
       <x-footer />
    </footer>
    @stack('scripts') {{-- Para scripts JS adicionales que las vistas hijas puedan añadir --}}
</body>
</html>
