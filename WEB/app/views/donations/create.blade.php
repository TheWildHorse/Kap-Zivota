@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Evidentiraj Donaciju</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'donations.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('user_id', 'Korisničko ime:', array('class'=>'col-md-4 control-label')) }}
            <div class="col-sm-6">
              {{ Form::select('user_id', $usernames, Input::old('user_id'), array('class'=>'form-control', 'placeholder'=>'User_id')) }}
            </div>
        </div>


<div class="form-group text-center">
    <div class="col-sm-12">
      {{ Form::submit('Evidentiraj', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}

@stop


