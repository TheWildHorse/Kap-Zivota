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

    <body data-twttr-rendered="true" style="background-image: url('img/crossword.png');">
        <div class="navbar navbar-default navbar-fixed-top" >
            <div class="container" style="font-size:132%">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Bootswatch</a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
                                <li><a href="./default/">Default</a></li>
                                <li class="divider"></li>
                                <li><a href="./cerulean/">Cerulean</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="./help/">Help</a>
                        </li>
                        <li>
                            <a href="http://news.bootswatch.com">Blog</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
                        <li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
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
                    <div class="col-lg-1" style="bottom:0"> <img width="85px" height="85px" src="img/footer_1.png"/></div>
                    <div class="col-lg-1" style="bottom:0"><img width="85px" height="85px" src="img/footer_2.png"/></div>
                    <div class="col-lg-1" style="bottom:0"><img width="85px" height="85px" src="img/footer_3.png"/></div>
                </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script>
        </script>
    </body>
</html>



