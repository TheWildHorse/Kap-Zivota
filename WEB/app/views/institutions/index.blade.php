@extends('layouts.scaffoldSuperAdmin')

@section('main')

<h1 class="text-center">Sve Institucije</h1>
<div class="well">
<p>{{ link_to_route('institutions.create', 'Dodaj Instituciju', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($institutions->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Ime</th>
				<th>Opis</th>
				<th> </th>
			</tr>
		</thead>

		<tbody>
			@foreach ($institutions as $institution)
				<tr>
					<td>{{{ $institution->name }}}</td>
					<td>{{{ $institution->description }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('institutions.destroy', $institution->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('institutions.edit', 'Edit', array($institution->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>

@else
	<p class="text-center">Trenutno ne postoji nijedna institucija.</p>
@endif
</div>

@stop
