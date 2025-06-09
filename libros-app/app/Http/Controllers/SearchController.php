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


        if (!$term) {
            return redirect()->route('home');
        }


        $posts = Post::query()
            ->where('title', 'LIKE', "%{$term}%")
            ->orWhere('author_name', 'LIKE', "%{$term}%")
            ->paginate(12)
            ->appends($request->query());

        return view('search.results', [
            'posts' => $posts,
            'term' => $term,
        ]);
    }
}
