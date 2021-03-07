<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\TagController;
use \App\Http\Controllers\Admin\PostConstroller;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\PageTagController;
use \App\Http\Controllers\PageCategoryController;
use \App\Http\Controllers\SearchController;
use \App\Http\Controllers\MailController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

//\Illuminate\Support\Facades\Auth::routes([ 'verify'=> true]);


Route::get('/email/verification-notification', function () {
    \Illuminate\Support\Facades\Auth::user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify', function () {
    return 'auth.verify-email';
})->middleware('auth')->name('verification.notice');
//
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/contacts', [MainController::class, 'contacts'])->name('page.contacts');
Route::get('/article/{slug}', [PostController::class, 'show'])->name('posts.detail');
Route::post('/article/{slug}/comment', [CommentController::class, 'store'])->name('comments.store');
//Route::post('/article/{slug}/like', [LikeController::class, 'like_post'])->name('like.post');
Route::get('/category/{slug}', [PageCategoryController::class, 'show'])->name('categories.detail');
Route::get('/tag/{slug}', [PageTagController::class, 'show'])->name('tag.detail');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::group(['prefix'=> 'like', 'middleware' => 'auth'], function() {
    Route::post('/article/{slug}', [LikeController::class, 'like_post'])->name('like.post');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
//    Route::resource('posts', PostConstroller::class);
});

Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginCreate'])->name('login.create');
    Route::post('/login', [UserController::class, 'loginStore'])->name('login.store');
});

Route::group(['middleware' => ['auth', 'verified']], function() {
   Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
   Route::put('/profile/{id}', [UserController::class, 'update'])->name('user.update');
    Route::resource('posts', PostConstroller::class);
//    Route::resource('users', UserController::class);
});

Route::group(['prefix' => 'mail'], function() {
    Route::post('/contacts', [MailController::class, 'contacts'])->name('mail.contacts');
});
Route::group(['prefix' => 'subscribe'], function() {
   Route::post('/', [\App\Http\Controllers\SubscriberController::class, 'store'])->name('subscribe');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

//Auth::routes(['verify' => true]);



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
