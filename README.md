🌎📚 Mundo Literario
Mundo Literario es una aplicación web desarrollada con el framework Laravel, pensada como una comunidad en línea para lectores apasionados. Aquí podrás descubrir, leer y debatir reseñas de libros, compartidas por un equipo experto.

✨ Funcionalidades Principales
🔐 Registro e inicio de sesión seguros.

📚 Navegación por categorías de reseñas, ordenables por:

Popularidad (cantidad de "Me Gusta")

Cantidad de publicaciones

📝 Exploración de reseñas de libros, ordenables por:

Popularidad (cantidad de "Me Gusta")

Calificación (estrellas)

💬 Interacción con las publicaciones:

Comentarios

"Me Gusta"

❤️ Listado personalizado de publicaciones favoritas.

🔍 Búsqueda por nombre del libro o autor.

🛠️ Panel de Administración:

Crear, editar y eliminar reseñas y categorías.

⚙️ Guía de Instalación
📋 Requisitos Previos
Asegúrate de tener instalados:

PHP 8.2 o superior

Composer (gestión de dependencias PHP)

Node.js y npm (gestión de dependencias JavaScript)

Git (para clonar el repositorio)

🛠️ Paso 1: Clonar el Repositorio
git clone https://github.com/gabigallardo/libros
cd libros-app
📦 Paso 2: Instalar Dependencias PHP
composer install
Esto instalará Laravel y todas las dependencias del backend.

⚙️ Paso 3: Configurar el Entorno
Copia el archivo .env.example a .env y ajústalo si es necesario:
cp .env.example .env
🗄️ Paso 4: Configurar la Base de Datos
Este proyecto utiliza SQLite para facilitar el desarrollo local:

Crea el archivo de base de datos vacío:

touch database/database.sqlite
Asegúrate de que el archivo .env contenga:

DB_CONNECTION=sqlite
DB_DATABASE=/ruta/completa/hasta/database/database.sqlite
🧱 Paso 5: Migraciones y Seeders
Crea las tablas y carga datos de prueba (categorías y reseñas):
php artisan migrate:fresh --seed
📦 Paso 6: Instalar Dependencias JavaScript
npm install
▶️ Paso 7: Ejecutar el Proyecto
composer run dev
Accede a la aplicación desde tu navegador en:
http://localhost:8000

🤝 Contribuciones
¿Tienes ideas o mejoras? ¡Los pull requests y sugerencias son bienvenidos!
