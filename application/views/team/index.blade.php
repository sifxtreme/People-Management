@layout('master')

@section('header')
<h3>Teams</h3>
@endsection

@section('content')

	<h4>Add a Team</h4>

	{{ Form::open('add_team', 'POST',array('class'=>'add')) }}

	{{ Form::token() }}

	{{ Form::label('name','Team Name') }}
	{{ Form::text('name', Input::old('name')) }}

	{{ Form::submit('Add Team') }}

	{{ Form::close() }}

	<hr />

	<h4>All Teams</h4>

	<div class="listing">

		@foreach(Team::all() as $single_team)
			<div>
				{{ Form::open('delete_team', 'POST', array('class'=>'delete')) }}
				{{ Form::token() }}

				{{ Form::hidden('id', $single_team->id) }}
				{{ Form::button('Delete Team',array('class'=>'btn btn-warning')) }}

				{{ Form::close() }}

				<span><i class="icon-play"></i>{{ HTML::link_to_route('team', $single_team->name, array($single_team->id)) }}</span>

			</div>
		@endforeach

	</div>


@endsection