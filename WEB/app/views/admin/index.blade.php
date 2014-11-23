@extends('layouts.scaffold')

@section('main')

<?php $sveGrupe = Blood::lists('type', 'id'); ?>
<script src="js/Chart.js"></script>


<style>
    dt {
        width: 40px;
        height: 40px;
        display: inline-block;
        overflow: hidden;
    }
    .preporucena {background-color: rgba(220,220,220,0.5); color: rgba(220,220,220,0.5); }
    .trenutna {background-color: rgba(151,187,205,0.5); color: rgba(151,187,205,0.5); }

    dd {
        display: inline-block;
        width: 15em;
        margin: 0 0 0 1em;
    }
</style>
<div class="col-lg-2">

</div>
<div class="col-lg-8">
    <canvas id="myChart">


    </canvas>
</div>
<div class="row">

    <div class="col-xs-5"></div>
    <div class="col-xs-5">
        <br/>
        <button id="btnOrder" style="margin-left:8%;font-size:120%"><img  src="img/alert.png"/><br/>Pozovi donatore</button>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" id="form" style="display:none">
        <div class="well bs-component">

            {{Form::open(array('class' => 'form-horizontal', 'action' => 'AdminController@sendPush'))}}
            <fieldset>

                <legend>Pozivanje donatora</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Naslov</label>
                    <div class="col-lg-10">
                        {{ Form::text('Naslov', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-2 control-label">Krvna grupa</label>
                    <div class="col-lg-10">
                        {{Form::select('bloodgroup',$sveGrupe, null, ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Dodatne informacije</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('Dodajteobavijesti', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {{ Form::submit('Pozovi',array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
        </div>
        </fieldset>
        {{Form::close()}}
        <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
</div>
</div>
<script src="{{ asset ('js/adminIndex.js')}}"></script>

@stop


