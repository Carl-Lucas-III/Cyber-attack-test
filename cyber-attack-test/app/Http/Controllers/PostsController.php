<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException as ValidationException;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $posts = Post::select('id','title','description','user_id')->orderBy('created_at', 'DESC')->paginate(10);
            return view('Posts', compact('posts'));
        } catch (\Exception $e) {
            // Log the error or display a custom error page
            Log::error($e->getMessage());
            abort(500, 'An error occurred while retrieving posts.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('CreatePost');
        } catch (\Exception $e) {
            // Log the error or display a custom error page
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            abort(500, 'An error occurred while loading the create post page.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    (new Unique('posts'))->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    })->ignore($request->post)
                ],
                'description' => 'required|string|min:10'
            ], [
                'title.required' => 'Please enter a title for your post.',
                'title.max' => 'The title may not be longer than :max characters.',
                'title.unique' => 'You have already created a post with that title.',
                'description.required' => 'Please enter a description for your post.',
                'description.min' => 'The description must be at least :min characters long.'
            ]);
            
            $post = new Post();
            $post->title = htmlentities(trim(strip_tags($validated['title'])));
            $post->description = htmlentities(trim(strip_tags($validated['description'])));
            $post->user_id = Auth::user()->id;
            
            $post->save();
            
            return redirect()->route('posts.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating your post. Please try again later.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Post $Post)
    {   
        return ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $Post)
{
    try {
        if (!$Post) {
            throw new Exception('Post not found');
        }
    
        if ($Post->user_id != Auth::user()->id) {
            throw new Exception('You do not own this post');
        }
    
        return view('UpdatePost', ['post' => $Post]);
    } catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $Post)
    {
        try {
            // validate the request inputs
            $validatedData = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    (new Unique('posts'))->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    })->ignore($request->post)
                ],
                'description' => 'required|string|min:10'
            ], [
                'title.required' => 'Please enter a title for your post.',
                'title.max' => 'The title may not be longer than :max characters.',
                'title.unique' => 'You have already created a post with that title.',
                'description.required' => 'Please enter a description for your post.',
                'description.min' => 'The description must be at least :min characters long.'
            ]);
    
            // sanitize the data
            if($validatedData['title'])
                $title = htmlentities(strip_tags(trim($validatedData['title'])));
            if($validatedData['description'])
                $description = htmlentities(strip_tags(trim($validatedData['description'])), ENT_QUOTES);
    
            // update the post with sanitized data
            $Post->update([
                'title' => $validatedData['title'] ? $title : $Post->title,
                'description' => $validatedData['description'] ? $description : $Post->description,
            ]);
    
            return redirect()->route('posts.index');
    
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'There was an error updating your post. Please try again later.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $Post)
{
    try {
        if (!$Post) {
            throw new ModelNotFoundException('Post not found');
        }
        
        if ($Post->user_id != Auth::user()->id) {
            throw new AuthorizationException('You do not own this post');
        }
        
        $Post->delete();
        
        return redirect()->back();
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 404);
    } catch (AuthorizationException $e) {
        return response()->json([
            'message' => $e->getMessage()
        ], 403);
    } catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'There was an error deleting your post. Please try again later.');
    }
}
}
