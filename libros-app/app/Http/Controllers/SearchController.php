<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $term = $request->input('search');

        // Si el término de búsqueda está vacío, no tiene sentido mostrar
        // una página de resultados vacía. Mejor lo devolvemos al inicio.
        if (!$term) {
            return redirect()->route('home');
        }

        // Si hay un término de búsqueda, realizamos la consulta
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$term}%")
            ->orWhere('author_name', 'LIKE', "%{$term}%")
            ->paginate(12)
            ->appends($request->query());

        // Devolvemos la vista con los resultados (o un mensaje de que no se encontró nada)
        return view('search.results', [
            'posts' => $posts,
            'term' => $term,
        ]);
    }
}
