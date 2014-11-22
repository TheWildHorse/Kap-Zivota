@extends('layouts.scaffold')

@section('main')


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
            <form class="form-horizontal">
                <fieldset>
                    <legend>Pozivanje donatora</legend>
                    <div class="form-group">
                        <label for="inputNaslov" class="col-lg-2 control-label">Naslov</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputNaslov" placeholder="Naslov">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOpis" class="col-lg-2 control-label">Opis</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="inputOpis" placeholder="Opis"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
    </div>
</div>
<script>

    var data = {
        labels: ["AB +", "AB -", "A +", "A -", "B +", "B -", "O +", "O -"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40, 22]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                highlightFill: "rgba(151,187,205,0.75)",
                highlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 86, 27, 90, 31]
            }
        ]
    };

    var ctx = document.getElementById("myChart").getContext("2d");
    var myNewChart = new Chart(ctx).Bar(data, {responsive: true});

    setInterval(function() {
        /*
         $.ajax({
         type: "GET",
         url: "api/",
         dataType: "json",
         success: function(dataArray){
         //id:dataArray.id,
         }
         });*/
    }, 5000);
    $('#btnOrder').click(function() {
        $('#form').toggle('slow');
        $("html, body").animate({scrollTop: 250}, "slow");
    });
</script>


@stop


