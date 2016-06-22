@extends('app')

@section('content')
	<h1 class="page-heading">Your notices</h1>
	<table class="table table-striped table-bordered">
		<thead>
			<th>This content:</th>
			<th>Accessible Here:</th>
			<th>Is infringing Upon My work here:</th>
			<th>Notice Sent:</th>
			<th>Content Removed</th>
		</thead>
		<tbody>
			@foreach($notices as $notice)
			<tr>
				<td>{{ $notice->infringing_title }}</td>
				<td>{!! link_to($notice->infringing_link) !!}</td>
				<td>{!! link_to($notice->original_link) !!}</td>
				<td>{{ $notice->created_at->diffForHumans() }}</td>
				<td>
					{!! Form::open(['data_remote', 'method' => 'PATCH', 'url' => 'notices/' . $notice->id]) !!}
	                <div class="form-group">
	                    {!! Form::checkbox('content_removed', $notice->content_removed, $notice->content_removed, ['class' => 'remove']) !!}
	                </div>
	                {!! Form::close() !!}
				</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="flash">
		Updated!
	</div>

@endsection