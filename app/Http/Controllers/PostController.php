<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function show($id)
    {
        $message = Post::find($id);
        return view("posts/show", ["message" => $message]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view("posts/edit", ["post" => $post]);
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

        if ($request->hasFile("new_image")) {
            $request->validate([
                "new_image" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            ]);

            if ($post->image_path) {
                Storage::delete($post->image_path);
            }

            $imagePath = $request->file("new_image")->store("public/images");
            $post->image_path =
                "storage/" . str_replace("public/", "", $imagePath);
        }

        $post->save();

        return redirect()
            ->route("edit-post", ["id" => $post->id])
            ->with("success", "Post updated successfully");
    }
    public function index()
    {
        $messages = Post::all();
        return view("posts/main", compact("messages"));
    }

    public function create()
    {
        return view("posts/post");
    }

    public function store(StorePostRequest $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "message" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $imagePath = $request->file("image")->store("public/images");

        $post = Post::create([
            "title" => $request->input("title"),
            "message" => $request->input("message"),
            "image_path" => "storage/" . str_replace("public/", "", $imagePath),
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

   
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post
        $post->delete();

        return redirect()->route('delete-posts', ['id' => $post->id])->with('success', 'Post deleted successfully.');// Replace 'view-posts' with the route to your list of posts
    }
}
