<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio de la aplicación.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $query = Post::query();

        if (!$user || !$user->isAdmin()) {
            $query->where('habilitated', true);
        }

        $baseQuery = $query;

        $mostLikedPosts = (clone $baseQuery)->withCount('likers')
            ->orderBy('likers_count', 'desc')
            ->limit(4)
            ->get();

        $latestPosts = (clone $baseQuery)->latest()->limit(4)->get();

        return view('home', [
            'mostLikedPosts' => $mostLikedPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
