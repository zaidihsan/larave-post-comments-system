<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('show.css') }}">
    <title>View Post</title>
</head>

<body>
    @php
        $loggedInUserId = auth()->user()->id;
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($post)
                    @if ($post->image_path)
                        <img src="{{ asset($post->image_path) }}" alt="Post Image">
                    @endif
                    <h4>Title:</h4>
                    <h6>{{ $post->title }}</h6>
                    <h4>Message:</h4>
                    <p>{{ $post->message }}</p>

                    @if ($post->user_id === $loggedInUserId)
                        <div class="button-row">
                            <a href="{{ route('edit-post', ['id' => $post->id]) }}" class="btn btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('delete-posts', ['id' => $post->id]) }}">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-4">
                <h2>Comments</h2>
                <ul>
                    @if ($post->comments->isEmpty())
                        <li>No comments yet.</li>
                    @else
                    @foreach ($post->comments as $comment)
                    <li class="comment">
                        @if ($comment->user)
                            <strong>{{ $comment->user->name}}:</strong>
                        @else
                            <strong>Unknown User</strong>
                        @endif
                        {{ $comment->comment_text }}
                    </li>
                @endforeach
                
                    @endif
                </ul>

                @auth
                    <h3>Add a Comment</h3>
                    <form method="POST" action="{{ route('post-comment', ['post_id' => $post->id]) }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="comment_text" name="comment_text" rows="3"
                                placeholder="Write your comment here"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @else
                    <p>You must be logged in to add a comment.</p>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
