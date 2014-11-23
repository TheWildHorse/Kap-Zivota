@extends('layouts.scaffold')

@section('main')

    <br>

    <h1 class="text-center">Zalihe Krvi</h1>

    <div class="row">

        <div class="col-md-2">

        </div>
        @foreach ($blood_types as $id => $type)
            <div class="col-md-1 well text-center">
                <span style="color:#CD3F3F; font-size: 48px;font-weight: bold;">{{{ $type }}}</span>
                <br>
                <span style="font-size: 18px">Doza: {{{ $quantities[$id] }}}</span>
                <br><br>
                <a href="{{ route("bloodsupplies.modify", array('blood_id' => $id, 'increment' => 1)) }}"><img style="height:30px;width:30px;" src="{{ asset('img/arrow_up.png') }}"/></a>
                <a href="{{ route("bloodsupplies.modify", array('blood_id' => $id, 'increment' => 0)) }}"><img style="height:30px;width:30px;" src="{{ asset('img/arrow_down.png') }}"/></a>
            </div>
        @endforeach
    </div>
