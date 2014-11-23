@extends('layouts.scaffoldMobile')

@section('main')

{{ HTML::script('js/owl.carousel.js') }}
{{ HTML::style('css/owl.carousel.css'); }}
{{ HTML::style('css/owl.theme.css'); }}
{{ HTML::style('css/owl.transitions.css'); }}
<script src="{{ asset ('js/Chart.js')}}"></script>

<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <h1 class="centeredText">Najviše donirano po grupi</h1>
        <canvas id="topGroup">
        </canvas>
    </div>
</div>

<hr style="border-top:1px solid #E8776B"/>
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <h1 class="centeredText">Top 10 donatora</h1>
        <canvas id="topDonors">
        </canvas>
    </div>
</div>
<hr style="border-top:1px solid #E8776B"/>
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <h1 class="centeredText">Donacije po instituciji</h1>
        <canvas id="institutionStatistic">
        </canvas>
    </div>
</div>

<style type="text/css">
    .centeredText{
        text-align: center;
    }
</style>

<script type="text/javascript" src="{{ asset ('js/statistics.js')}}"></script>


@stop