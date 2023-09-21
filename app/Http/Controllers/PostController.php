<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
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
