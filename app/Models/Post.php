<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'posts_categories');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->where('comment_id_parent', '=', null);
    }

    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'users_liked_posts');
    }
}
