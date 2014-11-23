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
</script>


@stop


