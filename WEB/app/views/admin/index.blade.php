@extends('layouts.scaffold')

@section('main')

<?php $sveGrupe = Blood::lists('type', 'id'); ?>
<script src="js/Chart.js"></script>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-8">
        <dl>
            <dt class="preporucena"></dt>
            <dd>Preporučena količina</dd>
            <dt class="trenutna"></dt>
            <dd>Trenutna količina</dd>
        </dl>
    </div>
</div>
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

           	{{Form::open(array('action' => 'AdminController@sendPush'))}}
                <fieldset>

                    <legend>Pozivanje donatora</legend>
                    <div class="form-group">
                        <label for="inputNaslov" class="col-lg-2 control-label">Naslov</label>
                        <div class="col-lg-10">
                         {{ Form::text('Naslov', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                                        <div class="form-group">
                                            <label for="textArea" class="col-lg-2 control-label">Odaberite krvnu grupu</label>
                                            <div class="col-lg-10">
                      {{Form::select('bloodgroup',$sveGrupe)}}
                      </div>
                      </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Dodatne informacije</label>
                        <div class="col-lg-10">
                           {{ Form::textarea('Dodajteobavijesti', null, ['class' => 'form-control']) }}
                                                </div>


                    </div>

                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {{ Form::submit('Pozovi',array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </fieldset>
            {{Form::close()}}
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
    </div>
</div>
<script>
getBloodLevelGroups();

setInterval(function() {
    getBloodLevelGroups();
}, 15000);

var groupsLoaded = 0;

function getBloodLevelGroups(){
    $.ajax({
        type: "GET",
        url: "api/statistics/institutions/1/bloodlevels",
        dataType: "json",
        success: function(criticalLevel) {
            $.ajax({
                type: "GET",
                url: "api/statistics/institutions/1/bloodgrouplevels",
                dataType: "json",
                success: function(dataArray) {
                    criticalLevel = criticalLevel["criticalLevel"];
                    var criticalLevelArray = {
                        "0-": criticalLevel,
                        "0+": criticalLevel,
                        "A-": criticalLevel,
                        "A+": criticalLevel,
                        "B-": criticalLevel,
                        "B+": criticalLevel,
                        "AB-": criticalLevel,
                        "AB+": criticalLevel
                    };
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
                    for (var i in dataArray) {
                        var bloodGroup = dataArray[i]["blood_id"];
                        var bloodQuantity = dataArray[i]["quantity"];
                        bloodGroupsQuantity[bloodGroup] = bloodQuantity;
                    }
                    fillChart(bloodGroupsQuantity, criticalLevelArray);
                }
            });
        }
    });
}

function fillChart(bloodGroupsQuantity, criticalLevel) {
    var data = {
        labels: ["AB +", "AB -", "A +", "A -", "B +", "B -", "O +", "O -"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                pointColor: "rgba(220,220,220,0.8)",
                pointStrokeColor: "rgba(220,220,220,0.8)",
                pointHighlightFill: "rgba(220,220,220,0.75)",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: criticalLevel
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                pointColor: "rgba(151,187,205,0.8)",
                pointStrokeColor: "rgba(151,187,205,0.8)",
                pointHighlightFill: "rgba(151,187,205,0.75)",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: bloodGroupsQuantity
            }
        ]
    };
    var ctx = document.getElementById("myChart").getContext("2d");
    var myNewChart = new Chart(ctx).Line(data, {responsive: true});
}

$('#btnOrder').click(function() {
    $('#form').toggle('slow');
    $("html, body").animate({scrollTop: 250}, "slow");
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
        color:"#F7464A",
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
        color:"#F7464A",
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

var dataTopDonors =[
    {
        value: 300,
        color:"#F7464A",
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
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Top 10 donatora</h1>
        <canvas id="topDonors">
        </canvas>
    </div>
</div>

<div class="row">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Donacije kroz mjesec u godini</h1>
        <canvas id="monthStatistic">
        </canvas>
    </div>
    <div class="col-lg-5">
        <h1 class="centeredText">Donacije kroz godine</h1>
        <canvas id="yearStatistic">
        </canvas>
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


