<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function show($id)
    {
        $message = Post::find($id);
        return view("show", ["message" => $message]);
        
  
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view("edit", ["post" => $post]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "message" => "required|string",
        ]);

        $post = Post::find($id);

        if (!$post) {
            return redirect()
                ->back()
                ->with("error", "Post not found");
        }

        $post->title = $request->input("title");
        $post->message = $request->input("message");

        $post->save();

        return redirect()
            ->route("edit-post", ["id" => $post->id])
            ->with("success", "Post updated successfully");
    }

    public function index()
    {
        $messages = Post::all();
        return view("main", compact("messages"));
    }

    public function create()
    {
        return view("post");
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            "title" => request("title"),
            "message" => request("message"),
            "user_id" => auth()->user()->id,
        ]);

        $request->session()->flash("success", "Post created successfully");

        return redirect()
            ->route("dashboard")
            ->with("success", "Post created successfully");
    }

    public function list()
    {
        $post = Post::with("user")->get();
        return $post;
    }
}
