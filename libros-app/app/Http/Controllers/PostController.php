<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class)->except(['show', 'toggleLike', 'likedPosts']);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.create', compact('categories'));
    }

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
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'poster' => 'nullable|url',
            'stars' => 'required|integer|min:0|max:5',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.show', $post)->with('success', '¡Reseña actualizada exitosamente!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        // Tras borrar, lo mejor es llevar al admin a una página que siga existiendo.
        return redirect()->route('home')->with('success', '¡Reseña eliminada exitosamente!');
    }


    public function toggleLike(Post $post)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->likes()->toggle($post->id);

        return back();
    }

    public function likedPosts()
    {
        //le digo a intelliphense que $user es una instancia de User
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $posts = $user->likes()->paginate(9);

        return view('posts.liked', compact('posts'));
    }
}
