@extends('layouts.scaffold')

@section('main')

    <br>

    <h1 class="text-center">Zalihe Krvi</h1>

    <div class="row">

        <div class="col-md-2">

        </div>
        @foreach ($blood_types as $id => $type)
            @foreach ($BloodSupplies as $BloodSupply)
                <div class="col-md-1 well text-center">
                @if($BloodSupply->blood_id == $id)
                    <span style="color:#CD3F3F; font-size: 48px;font-weight: bold;">{{{ $type }}}</span>
                    <br>
                    <span style="font-size: 18px">Doza: {{{ $BloodSupply->quantity }}}</span>
                @else
                    <span style="color:#CD3F3F; font-size: 48px;font-weight: bold;">{{{ $type }}}</span>
                    <br>
                    <span style="font-size: 18px">Doza: 0</span>
                @endif
                </div>
            @endforeach
        @endforeach
    </div>
