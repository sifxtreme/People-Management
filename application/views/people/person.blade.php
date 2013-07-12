@layout('master')

@section('content')

	@if(isset($people_id))
		{{ People::find($people_id)->name }}
	@endif


@endsection