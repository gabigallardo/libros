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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'poster' => 'nullable|url',
            'stars' => 'required|integer|min:0|max:5',
        ]);


        $postData = $validatedData;


        $postData['habilitated'] = $request->has('habilitated');

        Post::create($postData);

        return redirect()->route('home')->with('success', 'Post creado exitosamente.');
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

        $postData = $validatedData;

        $postData['habilitated'] = $request->has('habilitated');

        $post->update($postData);

        return redirect()->route('posts.show', $post)->with('success', '¡Reseña actualizada exitosamente!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('success', '¡Reseña eliminada exitosamente!');
    }
    public function toggleHabilitation(Post $post)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();


        if (!$user || !$user->isAdmin()) {
            abort(403, 'Acción no autorizada.');
        }

        $post->habilitated = !$post->habilitated;
        $post->save();

        $status = $post->habilitated ? 'habilitada' : 'deshabilitada';

        return back()->with('success', "La reseña ha sido $status.");
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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $posts = $user->likes()->paginate(9);

        return view('posts.liked', compact('posts'));
    }
}
