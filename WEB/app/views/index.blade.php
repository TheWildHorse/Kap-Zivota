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

<div style="padding:100px 0px 15px 0px;text-align:center;background-color: #EB4444; color: #FFF; font-size: 100px; width:100%">
    Ovaj mjesec je donirano <strong>{{$liters_donated}} litara</strong> krvi.
    <br>
    <a href="#"><img src="{{asset("img/android.png")}}"/></a>
    <a href="#" class="btn btn-lg btn-info">Saznaj kako i ti možeš donirati</a>
</div>

</div>

<div class="row">
    <div class="col-lg-4 col-md-offset-1">
        <h1>Tko može donirati krv?</h1>
        <p>
            Krv mogu donirati sve osobe 18-65 koje imaju više od 55 kilograma te ne boluju od kroničnih ili zaraznih bolesti. Žene mogu donirati krv jednom u 4 mjeseci, a muškarci jednom u 3 mjeseca. Ukoliko neznate svoju krvnu grupu, ne brinite, možete je saznati na licu mjesta.
        </p>
    </div>
    <div class="col-lg-4 col-md-offset-2">
        <h1>Kako se daruje krv?</h1>
        <p>
            Nakon kratkog razgovora s liječnikom te par jednostavnih testova vašeg zdravlja započinje proces darivanja krvi. Nakon što vam tehničar uvede iglu u venu, na vama je samo da mirno ležite 8-12 minuta. Cijeli proces traje svega 30ak minuta a može nekome spasiti život.
        </p>
    </div>
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
            Jednostavno praćenje i dokumentiranje krvnih donacija korisnika,
            kako bi se pravovremeno i jednostavno mogle kontrolirati zalihe krvi i dodijeliti ih najpotrebnijima.
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Top 10 donatora</h1>
        <canvas id="topDonors">
        </canvas>
        <div class="row">
            <div class="col-lg-7 col-lg-offset-3">
            Donatori mogu na jednostavan način saznati kada je institucijama za darivanje krvi najpotrebnija krv tako da im se pošalje obavijest na mobitel.
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
            Pomozite onima kojima je potrebna pomoć i skinite aplikaciju za mobitel te skupljajte i zabilježite postignuća vaših dobrih djela.
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