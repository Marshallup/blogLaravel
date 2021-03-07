<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

//    protected $fillable = ['user_id', 'post_id'];
//    protected $table = 'likes_posts';


//    public function posts()
//    {
//        return $this->belongsToMany(Post::class);
//    }
//
//    public function users()
//    {
//        return $this->belongsToMany(User::class, 'likes_posts');
////        return $this->morph(User::class, 'sdsd');
//    }

    protected $fillable = ['user_id'];
    protected $table = 'likeable';

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
