<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio de la aplicación.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener las 3 publicaciones con más "Me gusta"
        $mostLikedPosts = Post::withCount('likers')
            ->orderBy('likers_count', 'desc')
            ->limit(4)
            ->get();

        // Obtener las 3 últimas publicaciones
        $latestPosts = Post::latest()->limit(4)->get();

        //  Pasar los datos a la vista
        return view('home', [
            'mostLikedPosts' => $mostLikedPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
