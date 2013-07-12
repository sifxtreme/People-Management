<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Users / Teams</title>
	<meta name="viewport" content="width=device-width">
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="/css/styles.css" rel="stylesheet">

</head>

<body>

	<div class="wrapper">

		<h2><a href="/">Users / Teams</a></h2>

		@yield('header')

		@if(Session::has('error'))
			<div class="alert alert-error">
				{{ Session::get('error') }}
			</div>
		@endif

		@if(Session::has('success'))
			<div class="alert alert-success">
				{{ Session::get('success') }}
			</div>
		@endif

		@yield('content')

	</div>

	@if(Auth::check())
	<ul class="nav">
		<li>{{ HTML::link_to_route('teams','Teams') }}</li>
		<li>{{ HTML::link_to_route('people','People') }}</li>
	</ul>
	@endif

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	@yield('js')

</body>
</html>