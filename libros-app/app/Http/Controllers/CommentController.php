<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:5',
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->content,
        ]);

        return back()->with('success', '¡Comentario publicado!');
    }
    public function destroy(Comment $comment)
    {

        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comentario eliminado.');
    }
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validatedData = $request->validate([
            'content' => 'required|string|min:5',
        ]);

        $comment->update($validatedData);

        return back()->with('success', 'Comentario actualizado.');
    }
}
