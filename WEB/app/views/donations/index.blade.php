@extends('layouts.scaffold')

@section('main')
<p class="text-center">{{ link_to_route('donations.create', 'Evidentiraj Donaciju', null, array('class' => 'btn btn-lg btn-success')) }}</p>
<br>
<h1 class="text-center">Zadnjih 15 Donacija</h1>

@if ($donations->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Korisničko ime</th>
				<th>Ime</th>
				<th>Prezime</th>
				<th>Vrijeme donacije</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($donations as $donation)
				<tr>
					<td>{{{ $usernames[$donation->user_id] }}}</td>
					<td>{{{ $names[$donation->user_id] }}}</td>
					<td>{{{ $surnames[$donation->user_id] }}}</td>
					<td>{{{ $donation->time }}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no donations
@endif

@stop
