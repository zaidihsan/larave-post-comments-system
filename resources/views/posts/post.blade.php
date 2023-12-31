<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		<title>Contact Form</title>
		<link rel="stylesheet" href="{{ asset('post.css') }}">
		<link rel="icon" href= "https://www.reddit.com/favicon.ico"type="image/x-icon">  
	</head>

	<body>
		<div class="container">
			@auth
			<form class="contact-form" action="/post" method="post" enctype="multipart/form-data">
				@csrf
				<h1>Post</h1>
				<input type="hidden" id="user_id" name="user_id">

				<label for="title">Title:</label>
				<input type="text" id="title" name="title" required>

				<label for="message">Message:</label>
				<textarea id="message" name="message" rows="5" required></textarea>

				<label for="image">Image:</label>
				<input type="file" id="image" name="image" accept="image/*" required>

				<button type="submit">Submit</button>
			</form>
			@endauth
		</div>
		<script>
			@if(session('success'))
			toastr.success('{{ session('
				success ') }}');
			@endif
			toastr.options = {
				"positionClass": "toast-top-right",
				"progressBar": true,
			};
		</script>
	</body>

</html>