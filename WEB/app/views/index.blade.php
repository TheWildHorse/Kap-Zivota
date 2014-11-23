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

<script>

    function fillTopDonors(donorInfo, numDonations) {
        var dataTopDonors = [
            {
                value: numDonations[0],
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: donorInfo[0]
            },
            {
                value: numDonations[1],
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: donorInfo[1]
            },
            {
                value: numDonations[2],
                color: "#FDB45C",
                highlight: "#FFC870",
                label: donorInfo[2]
            },
            {
                value: numDonations[3],
                color: "green",
                highlight: "#66CD00",
                label: donorInfo[3]
            },
            {
                value: numDonations[4],
                color: "yellow",
                highlight: "#ffff66",
                label: donorInfo[4]
            }
        ];
        var ctx = document.getElementById("topDonors").getContext("2d");
        var myNewChart = new Chart(ctx).Pie(dataTopDonors, {responsive: true});
    }

    function getTopDonors() {
        $.ajax({
            type: "GET",
            url: "api/statistics/users/topten",
            dataType: "json",
            success: function(topTen) {
                var donorInfoArray = Array(
                        topTen[0]["name"] + " " + topTen[0]["surname"],
                        topTen[1]["name"] + " " + topTen[1]["surname"],
                        topTen[2]["name"] + " " + topTen[2]["surname"],
                        topTen[3]["name"] + " " + topTen[3]["surname"],
                        topTen[4]["name"] + " " + topTen[4]["surname"]
                        );
                var numDonationsArray = Array(
                        topTen[0]["broj"],
                        topTen[1]["broj"],
                        topTen[2]["broj"],
                        topTen[3]["broj"],
                        topTen[4]["broj"]
                        );
                fillTopDonors(donorInfoArray, numDonationsArray);
            }
        });
    }

    function fillTopGroups(bloodGroupsQuantity) {
        var dataTopGroup = {
            labels: ["AB +", "AB -", "A +", "A -", "B +", "B -", "O +", "O -"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [
                        bloodGroupsQuantity["AB+"],
                        bloodGroupsQuantity["AB-"],
                        bloodGroupsQuantity["A+"],
                        bloodGroupsQuantity["A-"],
                        bloodGroupsQuantity["B+"],
                        bloodGroupsQuantity["B-"],
                        bloodGroupsQuantity["0+"],
                        bloodGroupsQuantity["0-"]
                    ]
                }
            ]
        };

        var ctx = document.getElementById("topGroup").getContext("2d");
        var myNewChart = new Chart(ctx).Radar(dataTopGroup, {responsive: true});
    }

    function getTopGroups() {
        $.ajax({
            type: "GET",
            url: "api/statistics/users/topgroups",
            dataType: "json",
            success: function(topTen) {
                var bloodGroupsQuantity = {
                    "0-": 0,
                    "0+": 0,
                    "A-": 0,
                    "A+": 0,
                    "B-": 0,
                    "B+": 0,
                    "AB-": 0,
                    "AB+": 0
                };
                for (var i in topTen) {
                    var bloodGroup = topTen[i]["type"];
                    var bloodQuantity = topTen[i]["broj"];
                    bloodGroupsQuantity[bloodGroup] = bloodQuantity;
                }
                fillTopGroups(bloodGroupsQuantity);
            }
        });
    }

    function fillTopInstitutions(institutionNames, bloodGroupsQuantity) {

        var dataTopInstitutions = [
            {
                value: bloodGroupsQuantity[0],
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: institutionNames[0]
            },
            {
                value: bloodGroupsQuantity[1],
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: institutionNames[1]
            },
            {
                value: bloodGroupsQuantity[2],
                color: "#FDB45C",
                highlight: "#FFC870",
                label: institutionNames[2]
            },
            {
                value: bloodGroupsQuantity[3],
                color: "green",
                highlight: "#66CD00",
                label: institutionNames[3]
            },
            {
                value: bloodGroupsQuantity[4],
                color: "Yellow",
                highlight: "#ffff66",
                label: institutionNames[5]
            }
        ];

        var ctx = document.getElementById("institutionStatistic").getContext("2d");
        var myNewChart = new Chart(ctx).PolarArea(dataTopInstitutions, {responsive: true});
    }

    function getTopInstitutions() {
        $.ajax({
            type: "GET",
            url: "api/statistics/users/topinstitutionsdonations",
            dataType: "json",
            success: function(topTen) {
                var institutionNames = Array(
                        topTen[0]["name"],
                        topTen[1]["name"],
                        topTen[2]["name"],
                        topTen[3]["name"],
                        topTen[4]["name"]
                        );
                var bloodGroupsQuantity = Array(
                        topTen[0]["broj"],
                        topTen[1]["broj"],
                        topTen[2]["broj"],
                        topTen[3]["broj"],
                        topTen[4]["broj"]
                        );
                fillTopInstitutions(institutionNames, bloodGroupsQuantity);
            }
        });
    }

    getTopDonors();
    getTopGroups();
    getTopInstitutions();

</script>


@stop