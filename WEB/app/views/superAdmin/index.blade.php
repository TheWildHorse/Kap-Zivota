@extends('layouts.scaffoldSuperAdmin')

@section('main')

<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-5">
		<img width="150px" height="150px" class="img-responsive" src="{{ asset ("img/hospital.png") }}"/>
		<h1>Institucije</h1>
	</div>
	<div class="col-sm-3">
		<img width="150px" height="150px" class="img-responsive" src="{{ asset ("img/user.png") }}"/>
		<h1>Korisnici</h1>
	</div>
	<div class="col-sm-2"></div>
</div>

<style>

</style>

@stop