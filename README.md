# 📚 Mundo Literario

"Mundo Literario" es una aplicación web desarrollada con el framework Laravel, diseñada para ser una comunidad en línea donde los amantes de la lectura pueden descubrir, leer y debatir sobre reseñas de libros. El objetivo principal es ofrecer un espacio centralizado para que los usuarios puedan encontrar su próxima lectura basándose en las opiniones y valoraciones del equipo de expertos de Mundo Literario.

## ✨ Funcionalidades Principales

La plataforma cuenta con dos roles principales, cada uno con funcionalidades específicas para crear una experiencia completa.

#### Para Usuarios:
*  **Registro y Autenticación**: Sistema seguro de registro e inicio de sesión.
*  **Búsqueda Avanzada**: Permite buscar reseñas por título del libro o nombre del autor.
*  **Exploración de Categorías**: Navega por las reseñas agrupadas en categorías, con la opción de ordenarlas por popularidad (más "Me Gusta") o por cantidad de posts.
*  **Ordenamiento de Reseñas**: Dentro de cada categoría, las reseñas se pueden ordenar por calificación (estrellas) o por popularidad.
*  **Interacción Social**:
    * Deja **comentarios** en las reseñas para compartir tu opinión.
    * Marca tus publicaciones favoritas con un **"Me Gusta"**.
*  **Lista de Favoritos**: Accede a un listado personal con todas las publicaciones a las que les has dado "Me Gusta".

#### Para Administradores:
*  **Gestión de Contenido**: Privilegios para **crear, editar y eliminar** tanto reseñas (posts) como categorías, asegurando la calidad y organización de la plataforma.

## 🛠️ Tecnologías Utilizadas

Este proyecto está construido con un conjunto de tecnologías modernas y eficientes:

* **Backend**: Laravel 12, PHP 8.2
* **Frontend**: Tailwind CSS, Alpine.js
* **Base de Datos**: SQLite (para desarrollo local)
* **Herramientas de Desarrollo**: Vite, npm

## 🚀 Puesta en Marcha

Sigue estos pasos para instalar y ejecutar el proyecto en tu entorno local.

### Requisitos Previos

* PHP 8.2 o superior
* Composer
* Node.js y npm
* Git

### Pasos de Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/gabigallardo/libros](https://github.com/gabigallardo/libros)
    cd libros-app
    ```

2.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```

3.  **Configuración del Entorno:**
    Copia el archivo de ejemplo `.env.example` para crear tu propio archivo de configuración `.env`. Luego, genera la clave única de la aplicación.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Crear la Base de Datos y Poblarla:**
    Este único comando creará las tablas de la base de datos y la llenará con datos de prueba (categorías y posts) para que puedas empezar a usar la aplicación inmediatamente.
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Instalar dependencias de JavaScript:**
    ```bash
    npm install
    ```

6.  **Crear el Enlace Simbólico de Almacenamiento:**
    Este paso es crucial para que las imágenes y otros archivos se muestren correctamente.
    ```bash
    php artisan storage:link
    ```

7.  **Ejecutar el Proyecto:**
    Tu `composer.json` incluye un script que inicia el servidor de PHP y el compilador de Vite al mismo tiempo. ¡Es la forma más fácil de empezar!
    ```bash
    composer run dev
    ```
    ¡Listo! Ahora puedes acceder a la aplicación en `http://127.0.0.1:8000`.

## 🔑 Roles y Acceso

Para probar las funcionalidades de administrador, necesitas un usuario con ese rol.

1.  Regístrate en la aplicación de forma normal.
2.  Accede a tu base de datos SQLite (con una herramienta como DB Browser for SQLite).
3.  En la tabla `users`, busca tu usuario y cambia el valor de la columna `role` de `"user"` a `"admin"`.

Al volver a iniciar sesión, tendrás acceso a los paneles de creación y edición de contenido.

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 👨‍💻 Autor

* **Matías Gabriel Gallardo** - *Tecnicatura Universitaria en Desarrollo Web*

🤝 Contribuciones
¿Tienes ideas o mejoras? ¡Los pull requests y sugerencias son bienvenidos!
