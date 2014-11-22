<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> -->
        {{ HTML::style('css/bootstrap.css'); }}
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        {{ HTML::script('js/bootstrap.js') }}
        <style>
            .droplet {
                background-image: url("{{ asset("img/blood.svg") }}");
                background-size: 100% 100%;
                background-repeat: no-repeat;
                padding: 27% 40% 5% 40%;
            }
            .btn-login {
                background-color: #FFF;
                border: 0px solid;
            }
        </style>
    </head>

    <body style="background-image: url('{{ asset("img/light_wool.png") }}');">
        <div class="droplet">
            {{ Form::open(array('url' => '/login', 'class' => 'form-horizontal')) }}

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-lg-12">
                          {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            {{ Form::text('password', Input::old('password'), array('class'=>'form-control', 'placeholder'=>'Password')) }}
                        </div>
                    </div>
                <br/>
                <div class="form-group">
                    <div class="col-sm-12" style="text-align: center">
                      {{ Form::submit('Login', array('class' => 'btn btn-lg btn-login')) }}
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </body>
</html>