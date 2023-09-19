<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('post.css') }}">
</head>
<body>
    <div class="container">
        @auth
        <form class="contact-form" action="{{ route('post.store') }}" method="post">
            @csrf
            <h1>Post</h1>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            
            <button type="submit">Submit</button>
        </form>
        
        @else
       
        @endauth
    </div>
</body>
</html>
