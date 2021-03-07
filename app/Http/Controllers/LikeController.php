<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like_post($slug)
    {
//        $post_id = Post::where('id', $slug)->firstOrFail(['id'])->id;
//        $user_id = User::where('id', 2)->firstOrFail(['id'])->id;
//        $hasLikes = Like::with('users')->get();
//        $data['post_id'] = $post_id;
//        $data['user_id'] = $user_id;
////        $data = [ $post_id, $user_id];
////        dd($data);
////        Like::create($data);
//        dump($data);
//        return 'asdasd';

        if (Auth::check())
        {
            $post = Post::find($slug);
            $user = User::thisUser();

            $res = [];
            if($user->hasLike($post, $user))
            {
//            $post->likes()->first('user_id', $user->id)->delete();
                $post->likes()->where('user_id', $user->id)->delete();
                $res['user'] = '';
            } else {
                $post->likes()->create(['user_id' => $user->id]);
                $res['user'] = $user->name;
            }
//            $arr = [
//                'user' => $user->name
//            ];
            return response()->json($res);
//            return back();
        } else {
            return back()->with('error', 'Вы не авторизированны');
        }
//        $post = Post::find($slug);
//        $user = User::thisUser();
//
//        if($user->hasLike($post, $user))
//        {
////            $post->likes()->first('user_id', $user->id)->delete();
//            $post->likes()->where('user_id', $user->id)->delete();
//        } else {
//            $post->likes()->create(['user_id' => $user->id]);
//        }
//        return back();


//        dump($post->likes()->where('user_id', $user->id)->exists());


//        dump($user->likes());
//        $user->likes()->create(['user_id' => Auth::user()->id]);
//        $like = Like::where('likeable_id', 21)->with('user')->get();

//        $user->hasLike();

//        dump($like);
//        dump($user->likes());

//        $user = Auth::user();
//        $user = User::find(Auth::user()->id);
//        dump($user);
//        $user->likes()->create(['post_id' => $post->id]);
//        $post->likes();
//        dump($post->likes());

//        $post->likes()->create(['user_id' => Auth::user()->id]);



    }
}
