<?php

use App\Models\Post;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;


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
    Route::post('/posts/{post}/toggle-habilitation', [PostController::class, 'toggleHabilitation'])->name('posts.toggleHabilitation');


    // Rutas de recursos para Categories

    Route::resource('categories', CategoriesController::class);

    // Rutas del perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');

Route::get('/liked-posts', [PostController::class, 'likedPosts'])->name('posts.liked');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('posts.comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.destroy');
Route::put('/comments/{comment}', [CommentController::class, 'update'])
    ->middleware('auth')
    ->name('comments.update');
require __DIR__ . '/auth.php';
