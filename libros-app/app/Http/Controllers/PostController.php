<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa Auth

class PostController extends Controller
{
    public function __construct()
    {
        // Protegemos todas las rutas de posts, excepto la de mostrar un post individual
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class)->except(['show']);
    }

    public function index()
    {
        // Podrías crear una vista para que el admin vea todos los posts
        $posts = Post::latest()->paginate(15);
        return view('posts.index', compact('posts'));
    }

    /**
     * Muestra el formulario para crear un nuevo post.
     */
    public function create()
    {
        // Obtenemos todas las categorías para pasarlas al dropdown del formulario
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Guarda el nuevo post en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'poster' => 'nullable|url',
            'stars' => 'required|integer|min:0|max:5',
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Post creado exitosamente.');
    }

    public function show(Post $post)
    {
        // Carga los posts de la misma categoría para la sección "relacionados"
        // Excluimos el post actual y tomamos hasta 3 posts de forma aleatoria.
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function getEdit($id)
    {
        $post = Post::findOrFail($id); // Busca el post o lanza 404 si no existe
        return view('posts.edit', ['post' => $post]); // Pasa el post a la vista de edición
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function toggleLike(Post $post)
    {
        $user = Auth::user();

        $user->likes()->toggle($post->id);

        return back(); // Redirige al usuario a la página anterior
    }


    public function likedPosts()
    {
        $posts = Auth::user()->likes()->paginate(9);

        return view('posts.liked', compact('posts'));
    }
}
