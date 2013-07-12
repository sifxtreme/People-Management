@layout('master')

@section('header')
<h3>People</h3>
@endsection

@section('content')

	<h4>Add a Person</h4>

	{{ Form::open('add_people', 'POST', array('class'=>'add')) }}

	{{ Form::token() }}

	{{ Form::label('name','Person\'s Name') }}
	{{ Form::text('name', Input::old('name')) }}

	{{ Form::label('email', 'Email') }}
	{{ Form::text('email', Input::old('email')) }}

	{{ Form::submit('Add Person') }}

	{{ Form::close() }}

	<hr />

	<h4>All People</h4>

	<div class="listing">

		@foreach(People::all() as $single_person)
			<div>
				<!-- {{ HTML::link_to_route('person', $single_person->name, array($single_person->id)) }} -->

				{{ Form::open('delete_people', 'POST', array('class'=>'delete')) }}
				{{ Form::token() }}

				{{ Form::hidden('id', $single_person->id) }}
				{{ Form::button('Delete Person',array('class'=>'btn btn-warning')) }}

				{{ Form::close() }}

				<span>{{ $single_person->name }}</span>
			</div>
		@endforeach

	</div>


@endsection