<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)
                ->latest('created_at')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post ;
        //dd($request -> all());
        $post -> user_id = auth() -> user() -> id;
        $post -> content = $request -> input('content');
        $post -> save();

        return redirect() -> route('posts.index');
    }

    public function feed()
    {
        $followingIds = auth()->user()->followings()->pluck('users.id');

        $posts = Post::whereIn('user_id', $followingIds)
            ->with('user', 'likes')
            ->latest('created_at')
            ->get();

        return view('posts.feed', compact('posts'));
    }

    public function home()
    {
        $posts = Post::with('user', 'likes')
            ->latest('created_at')
            ->get();

        return view('posts.home', compact('posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post -> delete();
        return back();

    }

}
