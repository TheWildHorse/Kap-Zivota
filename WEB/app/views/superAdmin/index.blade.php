@extends('layouts.scaffoldSuperAdmin')

@section('main')
<br><br><br><br><br>
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-5">
		<a href="{{ route("institutions.index") }}"><img width="150px" height="150px" class="img-responsive" src="{{ asset ("img/hospital.png") }}"/></a>
		<h1>Institucije</h1>
	</div>
	<div class="col-sm-3">
		<a href="{{ route("users.index") }}"><img width="150px" height="150px" class="img-responsive" src="{{ asset ("img/user.png") }}"/></a>
		<h1>Korisnici</h1>
	</div>
	<div class="col-sm-2"></div>
</div>
<br><br><br><br><br>

<style>

</style>

@stop