@extends('layouts.scaffoldDefault')

@section('main')

{{ HTML::script('js/owl.carousel.js') }}
{{ HTML::style('css/owl.carousel.css'); }}
{{ HTML::style('css/owl.theme.css'); }}
{{ HTML::style('css/owl.transitions.css'); }}
<script src="js/Chart.js"></script>

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


var dataTopGroup = {
    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
    ]
};

var dataMonth = [
    {
        value: 300,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    },
    {
        value: 40,
        color: "#949FB1",
        highlight: "#A8B3C5",
        label: "Grey"
    },
    {
        value: 120,
        color: "#4D5360",
        highlight: "#616774",
        label: "Dark Grey"
    }
];




var dataYear = [
    {
        value: 300,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    }
];

var dataTopDonors = [
    {
        value: 300,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    }
];

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
    <div class="col-lg-1">
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Donacije kroz mjesec u godini</h1>
        <canvas id="monthStatistic">
        </canvas>
                <div class="row">
        	<div class="col-lg-7 col-lg-offset-3">
Quo mediocrem reprimique et, posse probatus maluisset te has. Movet regione pri ne, euismod iracundia gloriatur te vis. In veri nobis est. Ei idque altera philosophia sed. Cu has eligendi oporteat cotidieque, habeo possim molestie eum ex. Ei mundi euismod propriae nec, magna eruditi te eam, nam putent dolorum urbanitas ut.
        	</div>
        </div>
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Donacije kroz godine</h1>
        <canvas id="yearStatistic">
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

<script>

    var ctx = document.getElementById("topGroup").getContext("2d");
    var myNewChart = new Chart(ctx).Radar(dataTopGroup, {responsive: true});

    var ctx = document.getElementById("topDonors").getContext("2d");
    var myNewChart = new Chart(ctx).Pie(dataTopDonors, {responsive: true});

    var ctx = document.getElementById("monthStatistic").getContext("2d");
    var myNewChart = new Chart(ctx).PolarArea(dataMonth, {responsive: true});

    var ctx = document.getElementById("yearStatistic").getContext("2d");
    var myNewChart = new Chart(ctx).Doughnut(dataYear, {responsive: true});

</script>


 @stop