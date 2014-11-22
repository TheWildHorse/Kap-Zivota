@extends('layouts.scaffold')

@section('main')

<h1>Show Institution</h1>

<p>{{ link_to_route('institutions.index', 'Return to All institutions', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Id</th>
				<th>Name</th>
				<th>Description</th>
				<th>Geo_lat</th>
				<th>Get_long</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $institution->id }}}</td>
					<td>{{{ $institution->name }}}</td>
					<td>{{{ $institution->description }}}</td>
					<td>{{{ $institution->geo_lat }}}</td>
					<td>{{{ $institution->get_long }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('institutions.destroy', $institution->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('institutions.edit', 'Edit', array($institution->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
