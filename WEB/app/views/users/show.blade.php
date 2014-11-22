@extends('layouts.scaffold')

@section('main')

<h1>Show User</h1>

<p>{{ link_to_route('users.index', 'Return to All users', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Institution_id</th>
				<th>Blood_id</th>
				<th>Gener</th>
				<th>Username</th>
				<th>Password</th>
				<th>Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Birthdate</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $user->institution_id }}}</td>
					<td>{{{ $user->blood_id }}}</td>
					<td>{{{ $user->gener }}}</td>
					<td>{{{ $user->username }}}</td>
					<td>{{{ $user->password }}}</td>
					<td>{{{ $user->name }}}</td>
					<td>{{{ $user->surname }}}</td>
					<td>{{{ $user->email }}}</td>
					<td>{{{ $user->birthdate }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
