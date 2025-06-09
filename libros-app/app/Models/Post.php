<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    /**
     * 
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author_name',
        'content',
        'poster',
        'habilitated',
        'stars',
        'category_id',
    ];

    /**
     * obtiene la categoría a la que pertenece este post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function likers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_user');
    }

    public function isLikedByUser(User $user): bool
    {
        return $this->likers()->where('user_id', $user->id)->exists();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
