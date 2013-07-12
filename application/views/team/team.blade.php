@layout('master')

<?php $team = Team::find($team_id); ?>

@section('header')
<h3>Team Members - {{ $team->name }}</h3>
@endsection

@section('content')

	<h4>Add Person to Team</h4>

	{{ Form::open('add_people_to_team', 'POST', array('class'=>'add')) }}

	{{ Form::token() }}

	{{ Form::label('name','Person\'s Name') }}
	{{ Form::text('name', Input::old('name'), array('class'=>'typeahead','autocomplete'=>'off')) }}

	{{ Form::hidden('member_id', '', array('id'=>'member_id')) }}

	{{ Form::hidden('team_id', $team_id) }}

	{{ Form::submit('Add Person To Team') }}

	{{ Form::close() }}

	<hr />		

	<h4>People on Team</h4>
	<div class="listing">

		@if(count($team->peoples()->get()) > 0)
			@foreach($team->peoples()->get() as $single_person)
				
				<div>
					{{ Form::open('delete_people_from_team', 'POST', array('class'=>'delete')) }}
					{{ Form::token() }}

					{{ Form::hidden('member_id', $single_person->id) }}
					{{ Form::hidden('team_id', $team_id) }}

					{{ Form::button('Delete Person',array('class'=>'btn btn-warning')) }}

					{{ Form::close() }}

					<span>{{ $single_person->name }}</span>
				</div>

			@endforeach
		@endif

	</div>

@endsection


@section('js')
<?php

$names = array();
foreach(People::all() as $single_person){
	$names[] = $single_person->name.'---'.$single_person->id;
}
$js_names = json_encode($names);

?>
<script>
$(document).ready(function() {
  var subjects = <?php echo $js_names; ?>;
  console.log(subjects);

  $('.typeahead').typeahead({
    source:subjects,items:6,
  	matcher:function(item){
  		if(item.toLowerCase().replace(/---.*/,'').indexOf(this.query.trim().toLowerCase()) != -1){
  			return true;
  		}
  	},
  	highlighter: function(item){
  		var regex = new RegExp( '(' + this.query + ')', 'gi' );
  		return item.replace(/---.*/,'').replace( regex, "<strong>$1</strong>" );
  	},
  	updater:function(item){
  		var profile_id = item.replace(/.*---/,'');
      $('#member_id').attr('value', profile_id);
      // var profile_link = '<a href="{path=users/profile/}/'+profile_id+'">Profile</a>';
      // $('#member_link').html(profile_link);
			return item.replace(/---.*/,'');
  	}
  });

});
</script>
@endsection