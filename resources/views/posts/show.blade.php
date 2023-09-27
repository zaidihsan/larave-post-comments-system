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
        @if ($message)
            @if ($message->image_path)
                <img src="{{ asset($message->image_path) }}" alt="Post Image">
            @endif
            <h4>Title:</h4>
            <h6>{{ $message->title }}</h6>
            <h4>Message:</h4>
            <p>{{ $message->message }}</p>

            @if ($message->user_id === $loggedInUserId)
            <div class="button-row">
                <a href="{{ route('edit-post', ['id' => $message->id]) }}" class="btn btn-secondary">Edit</a>
                <form method="POST" action="{{ route('delete-posts', ['id' => $message->id]) }}">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </div>
            @endif
        @endif
    </div>
</body>

</html>
