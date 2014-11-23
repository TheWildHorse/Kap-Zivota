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

    <body data-twttr-rendered="true" style="background-image: url('{{ asset ('img/crossword.png')}} ');">


        
        @if (Session::has('message'))
        <div class="flash alert">
            <p>{{ Session::get('message') }}</p>
        </div>
        @endif

        @yield('main')

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    </body>
</html>


