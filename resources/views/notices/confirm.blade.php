@extends('app')

@section('content')
	<h1 class="page-heading">Confirm</h1>
	{!! Form::open(['action' => 'NoticesController@store']) !!}
	<!-- template Form Input -->
	<div class="form-group">
		{!! Form::textarea('template', $template, ['class' => 'form-control']) !!}
	</div>
	<!-- deliver Form Input -->
	<div class="form-group">
		{!! Form::submit('Deliver', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
@endsection