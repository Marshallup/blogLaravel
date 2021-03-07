<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'message'];


    /**
     * The belongs to Relationship
     *
     * @var array
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The has Many Relationship
     *
     * @var array
     */

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('M d, Y \a\t H:i:s a');
    }
}
