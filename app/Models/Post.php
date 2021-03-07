<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'content', 'category_id', 'thumbnail', 'user_id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function like()
//    {
//        return $this->belongsToMany(Like::class);
//    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable')->with('user');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function uploadImage($request, $image = null)
    {
        if($request->hasFile('thumbnail'))
        {
            if($image) {
                \Illuminate\Support\Facades\Storage::delete(asset($image));
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;

    }

    public function getImage()
    {
        if (!$this->thumbnail)
        {
            return asset('images/no-img.png');
        }
        return asset($this->thumbnail);
    }

    public function getPostDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS M, Y');
    }
    public function getPostDateDetail()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d M, Y H:i a');
    }
    public function getWidgetDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('M j');
    }

    public function setFormatComment($commentsCount)
    {
        if($commentsCount === 0)
        {
            return 0;
        } else {
            return sprintf('%02d', $commentsCount);
        }
    }

    public function scopeLike($query, $search)
    {
        return $query->where('title', 'LIKE', "%{$search}%");
    }


}
