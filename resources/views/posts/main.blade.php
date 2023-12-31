<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('main.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href= "https://www.reddit.com/favicon.ico" type="image/x-icon"> 
    <title>View Posts</title>
</head>

<body>
    <button onclick="document.getElementById('demo').innerHTML=Date()">Time</button><p id="demo"></p>
    @php
    $loggedInUserId = auth()->user()->id;
    @endphp
    <div class="container">
        <h2>Posts</h2>
        <div class="row">
            @foreach ($messages as $message)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="{{ asset($message->image_path) }}" alt="Post Image" class="img-fluid">
                        <h5 class="card-title">{{ $message->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($message->message, 20) }}</p>
                        <a href="{{ route('post-show', ['post_id' => $message->id]) }}">View Post</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
