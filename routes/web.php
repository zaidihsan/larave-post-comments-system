<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use App\Models\Comment;
use App\Livewire\Counter;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );

        Route::group(["prefix" => "post", "as" => "post."], function () {
        Route::get("/", [PostController::class, "create"])->name("create");
        Route::post("/", [PostController::class, "store"])->name("store");
        Route::get("/list", [PostController::class, "list"])->name("list");
   
    });
});
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/post/{post_id}', [PostController::class, 'show'])->name('post-show');
        Route::get('/posts/edit/{id}', [PostController::class,'edit'])->name('edit-post');
        Route::put('/update-post/{id}', [PostController::class,'update'])->name('update-post'); 
        Route::get('/delete-posts/{id}', [PostController::class,'destroy'])->name('delete-posts');
        Route::post('/post/{post_id}/comment', [CommentController::class, 'store'])->name('post-comment');
        Route::get('/post/{post_id}/comment',  [CommentController::class, 'store'])->name('post-comment');
        Route::patch('/comments/{comment_id}', [CommentController::class, 'update'])->name('edit-comment');
        Route::delete('/comments/{comment_id}', [CommentController::class, 'destroy'])->name('delete-comment');
        Route::get('/posts/{post}', [CommentController::class,'show'])->name('post.show');
        Route::get('/counter', Counter::class);
        require __DIR__ . "/auth.php";

