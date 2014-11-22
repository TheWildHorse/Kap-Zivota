@extends('layouts.scaffoldSuperAdmin')

@section('main')

<div class="row">
    <div class="col-md-7 col-md-offset-5">

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

<style type="text/css">
</style>

<div class ="well bs-component" style="background-color:white;font-size:140%">
{{ Form::open(array('url' => '/login', 'class' => 'form-horizontal')) }}
    
        <div class="form-group">
            {{ Form::label('email', 'Email:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-lg-10">
              {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-lg-10">
                {{ Form::text('password', Input::old('password'), array('class'=>'form-control', 'placeholder'=>'Password')) }}
            </div>
        </div>

<br/>
<div class="form-group">
    <label class="col-sm-5 control-label">&nbsp;</label>
    <div class="col-sm-7">
      {{ Form::submit('Login', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}
</div>
@stop


