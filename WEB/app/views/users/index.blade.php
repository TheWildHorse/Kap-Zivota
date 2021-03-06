@extends('layouts.scaffoldSuperAdmin')

@section('main')

<h1 class="text-center">Svi Korisnici</h1>

<div class="well">
@if ($users->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
			    <th>Korisničko ime</th>
			    <th>Ime</th>
                <th>Prezime</th>
                <th>Krvna grupa</th>
				<th>Spol</th>
				<th>Email</th>
				<th>Datum Rođenja</th>
				<th>Institucija</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
				    <td>{{{ $user->username }}}</td>
	                <td>{{{ $user->name }}}</td>
    				<td>{{{ $user->surname }}}</td>
    				<td>@if($user->blood_id > 0){{{ $blood_types[$user->blood_id] }}}@endif</td>
					<td>{{{ $user->gender }}}</td>
					<td>{{{ $user->email }}}</td>
					<td>{{{ $user->birthdate }}}</td>
					<td>@if($user->institution_id > 0){{{ $institutions[$user->institution_id]  }}}@endif</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Izbriši', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('users.edit', 'Uredi', array($user->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	Trenutno nema korisnika.
@endif
</div>

@stop
