@extends('layouts.scaffold')

@section('main')

<h1 class="text-center">Zalihe Krvi</h1>

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

				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no BloodSupplies
@endif

@stop
