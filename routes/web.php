<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Page d'accueil / fil d'actualité
// Le layout utilise route('posts.home') et route('home') : on conserve les deux noms.
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', [PostController::class, 'home'])->name('posts.home')->middleware('auth');
Route::get('/posts/feed', [PostController::class, 'feed'])->name('posts.feed')->middleware('auth');

// Likes
Route::post('/likes', [LikeController::class, 'like'])->name('likes.store');
Route::delete('/likes', [LikeController::class, 'dislike'])->name('likes.destroy');

// Posts (la resource fournit deja posts.destroy)
Route::resource('posts', PostController::class)->middleware('auth');

// Profils et abonnements
// A declarer AVANT la resource users pour ne pas etre masques par users/{user}
Route::get('users/profile/{user:name}', [UserController::class, 'profile'])->name('users.profile')->middleware('auth');
Route::get('/abonnes', [UserController::class, 'followers'])->name('users.followers');
Route::get('/users/followings', [UserController::class, 'followings'])->name('users.followings')->middleware('auth');
Route::post('/users/follow', [FollowController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::delete('/users/follow', [FollowController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

// Resources
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('notes', NoteController::class);
Route::post('/notes/{note}/to-post', [NoteController::class, 'transformToPost'])->name('notes.toPost');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
