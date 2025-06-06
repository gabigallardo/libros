<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Aplica el middleware de administrador a todos los métodos EXCEPTO a index y show.
     */
    public function __construct()
    {
        // Todos los usuarios logueados pueden ver el listado y el detalle.
        $this->middleware('auth');

        // Solo los administradores pueden crear, guardar, editar, actualizar y eliminar.
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class)->except(['index', 'show']);
    }

    /**
     * Muestra la lista de categorías (Público para usuarios logueados).
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Muestra el detalle de una categoría (Público para usuarios logueados).
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría (Solo para Admins).
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Guarda una nueva categoría en la base de datos (Solo para Admins).
     */
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

    /**
     * Muestra el formulario para editar la categoría (Solo para Admins).
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Actualiza la categoría en la base de datos (Solo para Admins).
     */
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

    /**
     * Elimina la categoría de la base de datos (Solo para Admins).
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
