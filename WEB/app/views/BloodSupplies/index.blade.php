@extends('layouts.scaffold')

@section('main')

<h1>All BloodSupplies</h1>

<p>{{ link_to_route('BloodSupplies.create', 'Add New BloodSupply', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($BloodSupplies->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Institution_id</th>
				<th>Blood_id</th>
				<th>Quantity</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($BloodSupplies as $BloodSupply)
				<tr>
					<td>{{{ $BloodSupply->institution_id }}}</td>
					<td>{{{ $BloodSupply->blood_id }}}</td>
					<td>{{{ $BloodSupply->quantity }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('BloodSupplies.destroy', $BloodSupply->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('BloodSupplies.edit', 'Edit', array($BloodSupply->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no BloodSupplies
@endif

@stop
