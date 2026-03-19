<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();

        return view('notes.index',[
            'notes' => Note::where('user_id', auth() -> user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $note = new Note ;
        $note -> user_id = auth() -> user() -> id;
        $note -> content = $request -> input('content');
        $note -> save();

        return redirect() -> route('notes.index');
    }

}
