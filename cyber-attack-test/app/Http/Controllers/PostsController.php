<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('Posts', ['posts' =>Post::select()->orderBy('id','DESC')->paginate(10)]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CreatePost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:posts',
            'description' => 'required|string'
        ]);
        
        $post = new Post();
        $post->title = htmlspecialchars(trim(strip_tags($validated['title'])));
        $post->description = htmlspecialchars(trim(strip_tags($validated['description'])));
        $post->user_id = Auth::user()->id;
        
        $post->save();
        
        return redirect()->route('posts.index');
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
        if (!$Post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }
    
        if ($Post->user_id == Auth::user()->id) {
            return view('UpdatePost', ['post' => $Post]);
        } else {
            return response()->json([
                'message' => 'You do not own this post'
            ], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $Post)
    {
        // validate the request inputs
    $validatedData = $request->validate([
        'title' => 'sometimes|max:255',
        'description' => 'sometimes',
    ]);
    
    // sanitize the data
    if($validatedData['title'])
    $title = strip_tags(trim($validatedData['title']));
    if($validatedData['description'])
    $description = htmlspecialchars(strip_tags(trim($validatedData['description'])), ENT_QUOTES);

    // update the post with sanitized data

    $Post->update([
        'title' => $validatedData['title']?$title:$Post->title,
        'description' => $validatedData['description']?$description:$Post->description,
    ]);

    return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $Post)
    {

        
        if($Post->user_id == Auth::user()->id){
   
            $Post->delete();
            
            return redirect()->back();
        }
        else
        return redirect()->back()->withErrors('this post is not yours')->withInput();
    }
}
