<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('css/bookonline.css') }}" >

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
        <script src="{{ asset('js/moment.min.js') }}" ></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" ></script>
        <style type="text/css">
            a { color: #000; }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container-fluid">
                <center>
                    <div class="col-md-6">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#admin">Admin</a></li>
                            <li><a data-toggle="pill" href="#member">Member</a></li>
                        </ul>
                          
                        <div class="tab-content">
                            <div id="admin" class="tab-pane fade in active">
                              <a href="{{ url('/login/admin') }}">Login Admin</a> | <a href="{{ url('/register/admin') }}">Register Admin</a>
                            </div>
                            <div id="member" class="tab-pane fade">
                              <a href="{{ url('/login/member') }}">Login Member</a> | <a href="{{ url('/register/member') }}">Register Member</a>
                            </div>
                        </div>
                    </div>
                </center>
                 
            </div>
        </div>
    </body>
</html>
