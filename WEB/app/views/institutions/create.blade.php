@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-1 text-center">
        <h1>Dodaj Instituciju</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>
<br>

{{ Form::open(array('route' => 'institutions.store', 'class' => 'form-horizontal')) }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Ime:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::text('name', Input::old('name'), array('class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Opis:', array('class'=>'col-md-4 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::textarea('description', Input::old('description'), array('class'=>'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('adresa', 'Adresa:', array('class'=>'col-md-2 control-label')) }}
                    <div class="col-sm-6">
                        <input type="text" id="adresa" class="form-control" />
                    </div>
                    <a href="#" id="dohvati_koordinate" class="btn btn-primary col-md-4">Dohvati koordinate</a>
                </div>
                <div class="form-group">
                    <div class="row">
                        {{ Form::label('geo_lat', 'Latituda:', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-sm-4">
                          {{ Form::text('geo_lat', Input::old('geo_lat'), array('class'=>'form-control', 'disabled' => '')) }}
                        </div>
                        {{ Form::label('geo_long', 'Longituda:', array('class'=>'col-md-2 control-label')) }}
                        <div class="col-sm-4">
                          {{ Form::text('geo_long', Input::old('geo_long'), array('class'=>'form-control', 'disabled' => '')) }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div style="height:200px; margin: 0; padding: 0;" id="map-canvas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <div class="col-sm-12">
              {{ Form::submit('Dodaj', array('class' => 'btn btn-lg btn-primary')) }}
            </div>
        </div>

{{ Form::close() }}

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdVcW5sK6AJVSAxb4PCsJkqwNvkBQQLwM"></script>
<script>
    var map;
      function initialize() {
        var mapOptions = {
          center: { lat: 44.4737849, lng: 16.4688717},
          zoom: 5
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);

    $(document).ready(function() {

        $('#dohvati_koordinate').click(function(e)
        {
            lat=0.0;
            lon =0.0;
            addressToCheck="";
            urlToCheck="";
            addressToCheck=$('#adresa').val();

            urlToCheck = "http://nominatim.openstreetmap.org/search?q="+addressToCheck+"&format=json";

            $.ajax({
                type:"GET",
                url: urlToCheck,
                //force to handle it as text
                dataType: "text",
                success: function(data) {
                    json = $.parseJSON(data);

                    lat = json[0].lat;
                    lon = json[0].lon;

                    a = parseFloat(lat);
                    b = parseFloat(lon);

                    $('#geo_lat').val(a);
                    $('#geo_long').val(b);

                    map.setCenter({lat: a, lng: b});
                    map.setZoom(16);
                    //new google.maps.Marker({position: {lat: a, lng: b}, map: map});
                }
            });
        });
    });
</script>

@stop


