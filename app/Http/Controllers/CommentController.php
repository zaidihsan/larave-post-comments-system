<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post; 

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $post = Post::with('comments.user')->find($post_id);

        $request->validate([
            "comment_text" => "required|string",
        ]);

        Comment::create([
            "post_id" => $post_id,
            "user_id" => auth()->user()->id,
            "comment_text" => $request->input("comment_text"),
        ]);

        return redirect()
            ->route("post-show", ["post_id" => $post_id])
            ->with("success", "Comment added successfully");
    }
}
