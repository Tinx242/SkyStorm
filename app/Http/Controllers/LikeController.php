<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        Like::firstOrCreate([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);

        return redirect()->back();
    }

    public function dislike(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        Like::where([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ])->delete();

        return redirect()->back();
    }
}
