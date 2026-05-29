<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{public function like(Request $request)
{
    $data = $request->validate([
        'post_id' => 'required|integer|exists:posts,id',
    ]);

    auth()->user()->likes()->attach($data['post_id']);

    return redirect()->back();
}

    public function dislike(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        auth()->user()->likes()->detach($data['post_id']);

        return redirect()->back();
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
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
