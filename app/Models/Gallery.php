<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    /**
     * Get the article that owns the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    /**
     * Get the user that owns the Gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
