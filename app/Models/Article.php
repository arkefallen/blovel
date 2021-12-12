<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Gallery;

class Article extends Model
{
    use HasFactory;
    protected $table = 'article';

    /**
     * Get the user that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Get all of the comments for the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }

    /**
     * Get all of the gallery for the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'article_id', 'id');
    }
}
