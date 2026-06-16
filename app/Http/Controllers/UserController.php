<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('name')
                ->where('id', '!=', auth()->user()->id)
                ->get()
        ]);
    }

    public function profile(User $user)
    {
        $isFollowing = auth()->user()->followings->contains($user->id);
        $isFollowingYou = $user->followings->contains(auth()->id());

        $posts = $user->posts()->latest()->get();

        return view('users.profile', [
            'profileUser'    => $user,
            'posts'          => $posts,
            'isFollowing'    => $isFollowing,
            'isFollowingYou' => $isFollowingYou,
        ]);
    }

    public function followings()
    {
        $followings = auth()->user()->followings()->get();
        return view('users.followings', compact('followings'));
    }

    public function followers()
    {
        $followers = auth()->user()->followers()->get();
        return view('users.followers', compact('followers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
