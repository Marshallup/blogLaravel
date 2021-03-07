<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdate;
use App\Jobs\SendEmailVericationAfterRegistrarion;
use App\Listeners\LogVerifiedUser;
use App\Models\User;
//use App\Rules\UserSameAttribute;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
//        event(new Registered($user));
//        event(new Verified($user));

        $this->dispatch(new SendEmailVericationAfterRegistrarion($user));

//        event(new LogVerifiedUser($user));

        return redirect()->home();
    }
    public function loginCreate()
    {
        return view('user.login');
    }
    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            session()->flash('success', 'You are logged');
            if(Auth::user()->is_admin) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->home();
            }
        }

        return redirect()->back()->with('error', 'Incorrect login or password');
        dd($request->all());
    }

    public function profile()
    {
//        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }


    public function show()
    {

    }

    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(UserProfileUpdate $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();
        if ($data['surname'] === null){
            $data['surname'] = '';
        }
        $data['thumbnail'] = User::uploadImage($request, $user->thumnail);
//        $data['thumbnail'] = 'sdsdsd';
//        dd($data);
//        $user->surname = 'dasdasd';
        $user->update($data);

//        $user->save($data);
        return back();


//        dd($data);

//        if($file = Post::uploadImage($request, $post->thumbnail))
//        {
//            $data['thumbnail'] = $file;
//        }
//
//        if ($request->hasFile('thumbnail'))
//        {
//            Storage::delete($post->thumbnail);
//            $folder = date('Y-m-d');
//            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}");
//        }
//
//
//        $post->update($data);
//        $post->tags()->sync($request->tags);
//
//        return redirect()->route('posts.index')->with('success', 'Изменения сохранены');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
