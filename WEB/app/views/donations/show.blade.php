@extends('layouts.scaffold')

@section('main')

<h1>Show Donation</h1>

<p>{{ link_to_route('donations.index', 'Return to All donations', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>User_id</th>
				<th>Institution_id</th>
				<th>Time</th>
				<th>Measure</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $donation->user_id }}}</td>
					<td>{{{ $donation->institution_id }}}</td>
					<td>{{{ $donation->time }}}</td>
					<td>{{{ $donation->measure }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('donations.destroy', $donation->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('donations.edit', 'Edit', array($donation->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
