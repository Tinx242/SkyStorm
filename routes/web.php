<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts/feed', [PostController::class, 'feed'])->name('posts.feed')->middleware('auth');
Route::resource('posts',PostController::class) -> middleware('auth');

Route::get('/users/followings', [UserController::class, 'followings'])->name('users.followings')->middleware('auth');
Route::post('/users/follow', [FollowController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::delete('/users/follow', [FollowController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('notes',NoteController::class);
Route::resource('users',UserController::class)-> middleware('auth');

