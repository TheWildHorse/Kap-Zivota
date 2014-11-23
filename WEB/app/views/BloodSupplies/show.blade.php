@extends('layouts.scaffold')

@section('main')

<h1>Show BloodSupply</h1>

<p>{{ link_to_route('BloodSupplies.index', 'Return to All BloodSupplies', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Institution_id</th>
				<th>Blood_id</th>
				<th>Quantity</th>
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>

@stop
