<?php

namespace App\Models;

use App\Notifications\SendEmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'thumbnail',
        'surname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

//    public function like()
//    {
//        return $this->belongsToMany(Like::class);
//    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public static function thisUser()
    {
        return Auth::user();
    }

//    public function sendEmailVerificationNotification()
//    {
//        $this->notify(new SendEmailVerification() );
//    }



    public static function uploadImage($request, $image = null)
    {
        if($request->hasFile('thumbnail'))
        {
            if($image) {
                \Illuminate\Support\Facades\Storage::delete(asset($image));
            }
            $folder = Auth::user()->id;
            return $request->file('thumbnail')->store("images/users/{$folder}");
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

    public function hasLike($post, $user)
    {
        return $post->likes()->where('user_id', $user->id)->exists();
//        $user = Auth::user();
////        $like = Like::with('user')->get();
//        $likes = Like::where('user_id', Auth::user()->id)->get();
//        foreach ($likes as $like)
//        {
//            dump($like);
//        }
//        dump($like);
    }
}
