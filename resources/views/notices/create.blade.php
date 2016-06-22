@extends('app')

@section('content')
	<h1 class="page-heading">Create a new notice</h1>
	{!! Form::open(['method' => 'GET', 'action' => 'NoticesController@confirm']) !!}
	<!-- provider_id Form Input -->
		<div class="form-group">
			{!! Form::label('provider_id', 'provider_id:') !!}
			{!! Form::select('provider_id',$providers, null, ['class' => 'form-control']) !!}
		</div>	
	<!-- Infringing_title Form Input -->
	<div class="form-group">
		{!! Form::label('infringing_title', 'Infringing_title:') !!}
		{!! Form::text('infringing_title', null, ['class' => 'form-control']) !!}
	</div>
	<!-- Infringing_link Form Input -->
	<div class="form-group">
		{!! Form::label('infringing_link', 'Infringing_link:') !!}
		{!! Form::text('infringing_link', null, ['class' => 'form-control']) !!}
	</div>
	<!-- original_link Form Input -->
	<div class="form-group">
		{!! Form::label('original_link', 'original_link:') !!}
		{!! Form::text('original_link', null, ['class' => 'form-control']) !!}
	</div>
	<!-- original_description Form Input -->
	<div class="form-group">
		{!! Form::label('original_description', 'original_description:') !!}
		{!! Form::textarea('original_description', null, ['class' => 'form-control']) !!}
	</div>
	<!-- Prevew Notice Form Input -->
	<div class="form-group">
		{!! Form::submit('Prevew Notice', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
	@include('errors.list')
@stop