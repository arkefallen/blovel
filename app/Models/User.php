<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Article;
use App\Models\Gallery;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    /**
     * Get all of the article for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->hasMany(Article::class, 'creator_id', 'id');
    }

    /**
     * Get all of the gallery for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery() 
    {
        return $this->hasMany(Gallery::class, 'user_id', 'id');
    }
}
