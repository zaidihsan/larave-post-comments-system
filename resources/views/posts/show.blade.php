<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
						<a href="{{ route('edit-post', ['id' => $post->id]) }}" class="btn btn-info">Edit</a>
						<form method="POST" action="{{ route('delete-posts', ['id' => $post->id]) }}">
							@csrf
							@method('GET')
							<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
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
							<strong>{{ $comment->user->name }}:</strong>

							@if ($comment->user->id === auth()->user()->id)
							<button onclick="editComment({{ $comment->id }})">
								<i class="fas fa-pencil-alt" style="color:rgb(11, 196, 213)"></i>

								<form method="POST" action="{{ route('delete-comment', ['comment_id' => $comment->id]) }}">
									@csrf
									@method('DELETE')
									<button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">
										<i class="fas fa-trash" style="color:red"></i>
									</button>
								</form>
								@elseif ($post->user_id === auth()->user()->id)
								<form method="POST" action="{{ route('delete-comment', ['comment_id' => $comment->id]) }}">
									@csrf
									@method('DELETE')
									<button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">
										<i class="fas fa-trash" style="color:red"></i>
									</button>
								</form>
								@endif

								<p id="comment-{{ $comment->id }}">{{ $comment->comment_text }}</p>
								<form id="edit-comment-form-{{ $comment->id }}" style="display: none;" method="POST" action="{{ route('edit-comment', ['comment_id' => $comment->id]) }}">
									@csrf
									@method('PATCH')
									<div class="form-group">
										<textarea class="form-control" id="edit-comment-text-{{ $comment->id }}" name="comment_text" rows="3" placeholder="Edit your comment here">{{ $comment->comment_text }}</textarea>
									</div>
									<i class="fas fa-save icon-button" style="color:rgb(12, 153, 228)" onclick="document.getElementById('edit-comment-form-{{ $comment->id }}').submit()"></i>
									<i class="fas fa-times icon-button" style="color:red" onclick="cancelEditComment({{ $comment->id }})"></i>
								</form>
						</li>
						@endforeach
						@endif
					</ul>
					@auth
					<h3>Add a Comment</h3>
					<form method="POST" action="{{ route('post-comment', ['post_id' => $post->id]) }}">
						@csrf
						<div class="form-group">
							<textarea class="form-control" id="comment_text" name="comment_text" rows="3" placeholder="Write your comment here"></textarea>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
					@else
					<p>You must be logged in to add a comment.</p>
					@endauth
				</div>
			</div>
		</div>
		<script>
			function editComment(commentId) {
				document.getElementById(`comment-${commentId}`).style.display = 'none';
				document.getElementById(`edit-comment-form-${commentId}`).style.display = 'block';
			}

			function cancelEditComment(commentId) {
				document.getElementById(`comment-${commentId}`).style.display = 'block';
				document.getElementById(`edit-comment-form-${commentId}`).style.display = 'none';
			}
		</script>
	</body>

</html>