@extends('layouts.scaffold')

@section('main')

<h1>All Bloods</h1>

<p>{{ link_to_route('bloods.create', 'Add New Blood', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($bloods->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Type</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($bloods as $blood)
				<tr>
					<td>{{{ $blood->type }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('bloods.destroy', $blood->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('bloods.edit', 'Edit', array($blood->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no bloods
@endif

@stop
