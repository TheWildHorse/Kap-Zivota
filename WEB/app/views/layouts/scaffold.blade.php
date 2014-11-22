<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> -->
       {{ HTML::style('css/bootstrap.css'); }}
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        {{ HTML::script('js/bootstrap.js') }}
        <style>
            body { padding-top: 20px; }
        </style>
    </head>

    <body data-twttr-rendered="true" style="background-image: url('{{ asset ('img/crossword.png') }} ');">
        <div class="navbar navbar-default navbar-fixed-top" >
            <div class="container" style="font-size:132%">

                <div class="navbar-header">


                    <img height="37px" width="45px" src="{{ asset ("img/logo1000_1000.png") }}"/>
                </div>
                <div class="navbar-header">
                    <a href="./" class="navbar-brand" style="color:#E8776B">  Kap života(Admin)</a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Evidencija <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
                                <li><a href="./default/">Ručni unos količine krvi</a></li>
                                <li class="divider"></li>
                                <li><a href="./cerulean/">Donacija u tijeku</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="./help/">Statistike</a>
                        </li>
                        <li>
                            <a href="http://news.bootswatch.com">Profili donora</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://builtwithbootstrap.com/" target="_blank">Moji podaci</a></li>
                        <li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">Odjava</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <br/><br/>
        <div class="splash">
            <div class="container">

                <div class="row">


                        @if (Session::has('message'))
                        <div class="flash alert">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                        @endif

                        @yield('main')

                </div>
            </div>
        </div>
        <hr style="border-top: 1px solid #E8776B;">
                <div class="row" style="bottom:0">
                    <div class="col-lg-2" style="bottom:0"></div>
                    <div class="col-lg-5" style="bottom:0">
                        <p>Kap života</p>
                        <p>Made by <a href="#" rel="nofollow">Noobs Freestyle</a> @ <a href="http://rsc.foi.hr/">HACKATHON</a>.</p>
                    </div>
                    <div class="col-lg-1" style="bottom:0"> <img width="85px" height="85px" src="{{ asset ("img/footer_1.png") }}"/></div>
                    <div class="col-lg-1" style="bottom:0"><img width="85px" height="85px" src="{{ asset ("img/footer_2.png") }}"/></div>
                    <div class="col-lg-1" style="bottom:0"><img width="85px" height="85px" src="{{ asset ("img/footer_3.png") }}"/></div>
                </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script>
        </script>
    </body>
</html>



