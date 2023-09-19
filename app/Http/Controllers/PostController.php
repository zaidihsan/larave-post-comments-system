<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('post');
    }
    
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        // Create a new Post instance
        $post = new Post;
        $post->title = $validatedData['title'];
        $post->message = $validatedData['message'];
        $post->save();
    
        // Redirect to a success page or show a success message
        return redirect()->route('dashboard')->with('success', 'Post created successfully');
    }
}
