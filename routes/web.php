<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('posts',PostController::class) -> middleware('auth');
Route::resource('notes',NoteController::class);
