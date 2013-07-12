@layout('master')

@section('content')

	@if(!Auth::check())

	{{ Form::open('/','POST',array('class'=>'add')) }}

	{{ Form::token() }}

	{{ Form::label('email', 'Email') }}
	{{ Form::text('email', Input::old('email')) }}

	{{ Form::label('password', 'Password') }}
	{{ Form::password('password') }}

	{{ Form::submit('Login') }}

	{{ Form::close() }}

	@else

	<h4>What would you like to do?</h4>
	<ul class="home">
		<li>{{ HTML::link_to_route('teams','Add/Remove Teams OR Add/Remove People to Teams') }}</li>
		<li>{{ HTML::link_to_route('people','Add/Remove People') }}</li>
	</ul>

	@endif

@endsection