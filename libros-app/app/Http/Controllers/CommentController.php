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
        // 1. Autorizar la acción usando la Policy.
        // Si no se cumple, Laravel lanzará un error 403 automáticamente.
        $this->authorize('delete', $comment);

        // 2. Si la autorización pasa, elimina el comentario.
        $comment->delete();

        return back()->with('success', 'Comentario eliminado.');
    }
    public function update(Request $request, Comment $comment)
    {
        // 1. Autorizamos que solo el dueño pueda editar
        $this->authorize('update', $comment);

        // 2. Validamos el contenido
        $validatedData = $request->validate([
            'content' => 'required|string|min:5',
        ]);

        // 3. Actualizamos el comentario
        $comment->update($validatedData);

        return back()->with('success', 'Comentario actualizado.');
    }
}
