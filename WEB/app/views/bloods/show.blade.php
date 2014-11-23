@extends('layouts.scaffold')

@section('main')

<h1>Show Blood</h1>

<p>{{ link_to_route('bloods.index', 'Return to All bloods', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Type</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $blood->type }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('bloods.destroy', $blood->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('bloods.edit', 'Edit', array($blood->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
