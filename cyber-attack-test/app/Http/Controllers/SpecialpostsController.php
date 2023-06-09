<?php

namespace App\Http\Controllers;

use App\Models\Specialpost;
use Illuminate\Http\Request;

class SpecialpostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('SpecialPosts' , ['specialPosts' =>Specialpost::select()->get()]);
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
        $validated = $request->validate([
            'name' => 'required|string|unique:posts',
            'description' => 'required|string'
        ]);

        $specialPost = new SpecialPost();
        $specialPost->name = $request->name;
        $specialPost->description = $request->description;

        $specialPost->save();

        return response()->json([
            'message' => 'SpecialPost created'
        ]);    }

    /**
     * Display the specified resource.
     */
    public function show(Specialpost $Specialpost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialpost $Specialpost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialpost $Specialpost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialpost $Specialpost)
    {
        //
    }
}
