<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request; // Asegúrate de que esto esté
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // Y también esto

class CategoriesController extends Controller
{
    /**
     * Aplica el middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class)->except(['index', 'show']);
    }

    /**
     * Muestra la lista de categorías con opción de ordenamiento.
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort');
        $query = Category::query();

        if ($sort === 'posts_count') {
            $query->withCount('posts')->orderBy('posts_count', 'desc');
        } elseif ($sort === 'likes') {

            $query->withCount(['posts as total_likes' => function ($query) {
                $query->select(DB::raw('count(*) as likes_sum'))
                    ->join('post_user', 'posts.id', '=', 'post_user.post_id');
            }])->orderBy('total_likes', 'desc');
        }

        $categories = $query->get();

        return view('category.index', compact('categories'));
    }

    public function show(Category $category, Request $request)
    {
        $sort = $request->query('sort');

        $postsQuery = $category->posts();

        if ($sort === 'stars') {
            $postsQuery->orderBy('stars', 'desc');
        } elseif ($sort === 'likes') {

            $postsQuery->withCount('likers')->orderBy('likers_count', 'desc');
        } else {
            $postsQuery->latest();
        }
        $posts = $postsQuery->paginate(9)->appends($request->query());

        return view('category.show', compact('category', 'posts'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
