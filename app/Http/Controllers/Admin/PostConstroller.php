<?php

namespace App\Http\Controllers\Admin;

use App\Events\onArticleCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\StorePost;
use App\Jobs\BlogPostAfterCreate;
use App\Mail\NewsLetterMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostConstroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(10);
//        $userPosts = Post::with('user')->where('author_id', Auth::user()->id)->paginate(10);
//        $userPosts = Post::with('user')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        $subscribers = Subscriber::get('email');

//        foreach ($subscribers as $subscriber) {
//            BlogPostAfterCreate::dispatch($subscriber->email);
//        }




//        Mail::to('televonvea@gmail.com')->send(new NewsLetterMail());
//        dispatch(new BlogPostAfterCreate());

//        dispatch(new BlogPostAfterCreate($subscribers));
//        BlogPostAfterCreate::dispatch($subscribers);
//        Mail::to('televonvea@gmail.com')->send(new NewsLetterMail());

//        foreach ($subscribers as $subscriber) {
//            dispatch(new BlogPostAfterCreate($subscriber->email));
//        }

//        Mail::to($subscribers)->queue( new NewsLetterMail() );

//        dd(Subscriber::get('email'));
//        NewsLetterMail::dispatch();


//        BlogPostAfterCreate::dispatch($subscribers);
//        dispatch(new BlogPostAfterCreate());


//            Mail::to(['televonvea@gmail.com', 'televonvea@gmail.com'])->send(new NewsLetterMail());

//        Mail::to(['1111@dasdas.com', 'televonvea@gmail.com'])->send( new NewsLetterMail() );

        event(new onArticleCreate($subscribers));

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image'
        ]);

        $data = $request->all();

        $data['thumbnail'] = Post::uploadImage($request);

//        $data['user_id'] = $this->setUserHavePostsAndAuthorPost($data);
        $data['user_id'] = Auth::user()->id;
        $this->setUserHavePosts();

        $post = Post::create($data);
        $post->tags()->sync($request->tags);

//        dd($request->all());

        return redirect()->route('posts.index')->with('success', 'Статья добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.edit', compact( 'post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = Post::find($id);
        $data = $request->all();

        if($file = Post::uploadImage($request, $post->thumbnail))
        {
            $data['thumbnail'] = $file;
        }

        if ($request->hasFile('thumbnail'))
        {
            Storage::delete($post->thumbnail);
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}");
        }

        $post->update($data);
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $postTitle = $post->title;
        $post->tags()->sync([]);
        Storage::delete(asset($post->thumbnail));
        $post->delete();
        return redirect()->route('posts.index')->with('success', "Статья - \"$postTitle\" удалена");
    }


    protected function setUserHavePosts()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_has_posts = $user->has_posts;

        if ($user_has_posts !== 1)
        {
            $user = User::find($user_id);
            $user->has_posts = 1;
            $user->save();
        }
//        dump($user);
    }
}
