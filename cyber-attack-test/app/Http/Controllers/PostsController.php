<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('Posts', ['posts' =>Post::select()->get()]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|unique:posts',
            'description' => 'required|string'
        ]);

        $post = new Post();
        $post->name = $request->name;
        $post->description = $request->description;

        $post->save();

        return response()->json([
            'message' => 'Post created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $Post)
    {
        return $Post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $Post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $Post)
    {
        $Post->update([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $Post)
    {
        $Post->delete();
    }
}
