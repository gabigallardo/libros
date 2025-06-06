<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-yellow-100 font-sans leading-relaxed text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-5 flex justify-between items-center">
            <!-- Logo como enlace al inicio -->
            <a href="/">
                <img src="https://i.pinimg.com/736x/fe/2d/0d/fe2d0d024e4f1b860fda1f3c16749638.jpg" alt="Logo de la aplicación" class="w-16 h-16">
            </a>
            <nav>
                <ul class="flex space-x-6 text-blue-700 font-medium">
                    <li><a href="/" class="hover:underline">Inicio</a></li>
                    <li><a href="/category" class="hover:underline">Ver Categorías</a></li>
                    <li><a href="/category/create" class="hover:underline">Añadir Post</a></li>
                    <li><a href="/login" class="hover:underline">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-blue-700 text-center py-4 mt-10 shadow-inner">
        <p>&copy; {{ date('Y') }} Libros App. Reseñas por Gabriel Gallardo.</p>
    </footer>

</body>

</html>