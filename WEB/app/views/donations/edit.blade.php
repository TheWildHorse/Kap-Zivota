@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Donation</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($donation, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('donations.update', $donation->id))) }}

        <div class="form-group">
            {{ Form::label('user_id', 'User_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('user_id', Input::old('user_id'), array('class'=>'form-control', 'placeholder'=>'User_id')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('institution_id', 'Institution_id:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('institution_id', Input::old('institution_id'), array('class'=>'form-control', 'placeholder'=>'Institution_id')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('time', 'Time:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('time', Input::old('time'), array('class'=>'form-control', 'placeholder'=>'Time')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('measure', 'Measure:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('measure', Input::old('measure'), array('class'=>'form-control', 'placeholder'=>'Measure')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('donations.show', 'Cancel', $donation->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop