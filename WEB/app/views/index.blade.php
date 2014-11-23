@extends('layouts.scaffoldDefault')

@section('main')

{{ HTML::script('js/owl.carousel.js') }}
{{ HTML::style('css/owl.carousel.css'); }}
{{ HTML::style('css/owl.theme.css'); }}
{{ HTML::style('css/owl.transitions.css'); }}
<script src="{{ asset ('js/Chart.js')}}"></script>

<!--<div class="content">
    <div class="row">

        <div class="col-lg-8 col-lg-offset-2">
    <div id="owl-demo" class="owl-carousel owl-theme">
            <div class="item">
                <img height="420" width="520" src="{{ asset ('img/carousel1.jpg')}}" alt="carousel1">
            </div>
            <div class="item">
                <img height="420" width="520" src="{{ asset ('img/carousel2.jpg')}}" alt="carousel1">
            </div>
            <div class="item">
                <img height="420" width="520" src="{{ asset ('img/carousel3.jpg')}}" alt="carousel1">
            </div>
            <div class="item">
                <img height="420" width="520" src="{{ asset ('img/carousel4.jpg')}}" alt="carousel1">
            </div>
            </div>
    </div>

</div>-->

<div style="padding:100px 0px 15px 0px;text-align:center;background-color: #EB4444; color: #FFF; font-size: 100px; height: 550px; width:100%">
    Ovaj mjesec je donirano <strong>{{$liters_donated}} litara</strong> krvi.
    <br>
    <a href="#"><img src="{{asset("img/android.png")}}"/></a>
    <a href="#" class="btn btn-lg btn-info">Saznaj kako i ti možeš donirati</a>
</div>

</div>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <h3>Lorem ipsum dolor sit amet, vis numquam tincidunt ea, ludus splendide mel ei. Ut sed doming rationibus. Quot illum duo ne, ne velit oblique detraxit ius. Homero essent ceteros cu sit, ad melius propriae accommodare eos. No accumsan tincidunt mei, nonumes incorrupte dissentias per at.

            Eu duis sanctus oporteat pri, quo porro exerci reprehendunt ex. No alii vidit disputando vim, prima mentitum philosophia ei ius. Quo suscipit praesent elaboraret in. Id ullum minimum appetere pro, vel veri lorem ex.

            Quo mediocrem reprimique et, posse probatus maluisset te has. Movet regione pri ne, euismod iracundia gloriatur te vis. In veri nobis est. Ei idque altera philosophia sed. Cu has eligendi oporteat cotidieque, habeo possim molestie eum ex. Ei mundi euismod propriae nec, magna eruditi te eam, nam putent dolorum urbanitas ut.
        </h3></div>
</div>
<hr style="border-top:1px solid #E8776B"/>

<script type="text/javascript">
    $("#owl-demo").owlCarousel({
        autoPlay: 8000,
        items: 2,
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [979, 1]
    });
</script>


<div class="row">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Najviše donirano po grupi</h1>
        <canvas id="topGroup">
        </canvas>
        <div class="row">
            <div class="col-lg-7 col-lg-offset-3">
                Quo mediocrem reprimique et, posse probatus maluisset te has. Movet regione pri ne, euismod iracundia gloriatur te vis. In veri nobis est. Ei idque altera philosophia sed. Cu has eligendi oporteat cotidieque, habeo possim molestie eum ex. Ei mundi euismod propriae nec, magna eruditi te eam, nam putent dolorum urbanitas ut.
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Top 10 donatora</h1>
        <canvas id="topDonors">
        </canvas>
        <div class="row">
            <div class="col-lg-7 col-lg-offset-3">
                Quo mediocrem reprimique et, posse probatus maluisset te has. Movet regione pri ne, euismod iracundia gloriatur te vis. In veri nobis est. Ei idque altera philosophia sed. Cu has eligendi oporteat cotidieque, habeo possim molestie eum ex. Ei mundi euismod propriae nec, magna eruditi te eam, nam putent dolorum urbanitas ut.
            </div>
        </div>
    </div>
</div>
<br/>
<hr style="border-top:1px solid #E8776B"/>
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <h1 class="centeredText">Donacije po instituciji</h1>
        <canvas id="institutionStatistic">
        </canvas>
        <div class="row">
            <div class="col-lg-7 col-lg-offset-3">
                Quo mediocrem reprimique et, posse probatus maluisset te has. Movet regione pri ne, euismod iracundia gloriatur te vis. In veri nobis est. Ei idque altera philosophia sed. Cu has eligendi oporteat cotidieque, habeo possim molestie eum ex. Ei mundi euismod propriae nec, magna eruditi te eam, nam putent dolorum urbanitas ut.
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .centeredText{
        text-align: center;
    }
</style>

<script type="text/javascript" src="{{ asset ('js/statistics.js')}}"></script>


@stop