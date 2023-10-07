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
        $post = Post::with("comments.user")->find($post_id);

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

    public function update(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        if (
            $comment->post->user_id === auth()->user()->id ||
            $comment->user_id === auth()->user()->id
        ) {
            $request->validate([
                "comment_text" => "required|string",
            ]);

            $comment->update([
                "comment_text" => $request->input("comment_text"),
            ]);

            return redirect()
                ->route("post.show", ["post" => $comment->post_id])
                ->with("success", "Comment updated successfully.");
        } else {
            return back()->with(
                "error",
                "You are not authorized to edit this comment."
            );
        }
    }

    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        if (
            $comment->user_id === auth()->user()->id ||
            $comment->post->user_id === auth()->user()->id
        ) {
            $comment->delete();

            return back()->with("success", "Comment deleted successfully.");
        } else {
            return back()->with(
                "error",
                "You are not authorized to delete this comment."
            );
        }
    }
    public function show(Post $post)
    {
        $post->load("comments");

        return view("posts.show", compact("post"));
    }
}
