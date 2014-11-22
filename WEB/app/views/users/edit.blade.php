@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Uredi Korisnika</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<br>

{{ Form::model($user, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('users.update', $user->id))) }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('username', 'Korisničko ime:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Username')) }}
                    </div>
                </div>
                <div class="form-group">
                     {{ Form::label('gender', 'Spol:', array('class'=>'col-md-4 control-label')) }}
                     <div class="col-sm-8">
                       {{ Form::text('gender', Input::old('gender'), array('class'=>'form-control', 'placeholder'=>'')) }}
                     </div>
                </div>
                <div class="form-group">
                     {{ Form::label('email', 'Email:', array('class'=>'col-md-4 control-label')) }}
                     <div class="col-sm-8">
                       {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
                     </div>
                </div>
                <div class="form-group">
                    {{ Form::label('blood_id', 'Krvna grupa:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::select('blood_id', $blood_types, Input::old('blood_id'), array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Ime:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('surname', 'Prezime:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::text('surname', Input::old('surname'), array('class'=>'form-control', 'placeholder'=>'Surname')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('birthdate', 'Datum rođenja:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::text('birthdate', Input::old('birthdate'), array('class'=>'form-control', 'placeholder'=>'Birthdate')) }}
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('institution_id', 'Institucija:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::select('institution_id', $institutions, Input::old('institution_id'), array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    {{ Form::label('premission_id', 'Razina dopuštenja:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                      {{ Form::select('premission_id', $premissions, Input::old('premission_id'), array('class' => 'form-control')) }}
                    </div>
                 </div>
            </div>
        </div>








<div class="form-group text-center">
    <div class="col-sm-12">
      {{ Form::submit('Spremi', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('users.index', 'Odustani', $user->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop