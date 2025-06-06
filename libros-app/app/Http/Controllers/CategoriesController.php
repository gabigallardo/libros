<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        // 3. Pasa la colección de categorías a la vista
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }
}
