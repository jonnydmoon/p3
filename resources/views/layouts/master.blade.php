<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <title>
		{{-- Yield the title if it exists, otherwise show default --}}
		@yield('title','Developer\'s Best Friend')
	</title>
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7COswald%7CCutive+Mono" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="css/app.css" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
	<link rel="icon" href="favicon.ico" />
	<script   src="http://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container-fluid header">
		<div class="container">
			<header class="row">
				<div class="col-sm-4">
					<div class="logo">
						<div class="logo-title">DEVELOPER'S BEST FRIEND</div>
						<div class="logo-subTitle">A collection of tools for web development</div>
					</div>

				</div>
				<nav class="col-sm-8">
					<a class="{{ Request::is('lorem-ipsum*') ? 'active' : '' }}" href="{{ URL::route('lorem-ipsum.index') }}">Lorem Ipsum</a>
					<a class="{{ Request::is('password-generator*') ? 'active' : '' }}" href="{{ URL::route('password-generator.index') }}">Password Generator</a>
					<a class="{{ Request::is('user-generator*') ? 'active' : '' }}" href="{{ URL::route('user-generator.index') }}">User Content</a>
				</nav>
			</header>
		</div>
	</div>
	<div class="container-fluid">
		<main class="container main-content">
			<div class="row main-row">
				<div class="col-sm-12">
					
					{{-- Global error section --}}
					@foreach ($errors as $error)
						<div class="alert alert-danger" role="alert"> <strong>Error</strong> {{ implode('<br /><strong>Error</strong> ', $errors) }}</div>
					@endforeach

					{{-- Page Title --}}
					<div class="page-title">@yield('pageTitle')  <i class="fa fa-question-circle page-help" aria-hidden="true" data-toggle="tooltip" title="@yield('pageHelp')"></i></div>

					{{-- Main page content --}}
					@yield('content')

			</div>

			<footer>
				<div class='copyright'>
					&copy; {{ date('Y') }}
				</div>
			</footer>
		</main>
	</div>
	<script src="js/app.js"></script>
</body>
</html>