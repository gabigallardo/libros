<?php

use App\Models\Post;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;

// Ruta para la página de bienvenida para usuarios no autenticados
Route::get('/', function () {
    $mostLikedPosts = Post::withCount('likers')
        ->orderBy('likers_count', 'desc')
        ->limit(3)
        ->get();

    $latestPosts = Post::latest()->limit(3)->get();

    return view('welcome', [
        'mostLikedPosts' => $mostLikedPosts,
        'latestPosts' => $latestPosts,
    ]);
})->middleware('guest')->name('welcome');

// Rutas para usuarios autenticados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Rutas de recursos para Posts
    Route::resource('posts', PostController::class);

    // Rutas de recursos para Categories
    Route::resource('categories', CategoriesController::class);

    // Rutas del perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ... en routes/web.php dentro del grupo 'auth'

// Ruta para manejar el dar/quitar like
Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');

// Ruta para mostrar las publicaciones que le gustaron al usuario
Route::get('/liked-posts', [PostController::class, 'likedPosts'])->name('posts.liked');
require __DIR__ . '/auth.php';
