<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede actualizar el comentario.
     * Solo el dueño del comentario puede editarlo.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determina si el usuario puede eliminar el comentario.
     * El dueño del comentario O un administrador pueden eliminarlo.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->isAdmin();
    }
}
