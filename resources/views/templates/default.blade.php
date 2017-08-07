<!doctype html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <title>PHP Developers' Space</title>
        <link rel="stylesheet" href="{{URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')}}">
        <link href="{{URL::asset('../public/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('../public/css/custom.css')}}" rel="stylesheet" type="text/css">
        @include('templates.partials.navigation')
    </head>

    <body>
        <div class="container">
            @include('templates.partials.phpLogo')
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 blog-main">
                    @include('templates.partials.alert')
                    @yield('content')
                </div>
                @yield('sideBar')
            </div>
        </div>
        @include('templates.partials.footer')
        <script src="{{URL::asset('../public/js/jquery-3.2.1.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../public/js/bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../public/js/script.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('../public/js/custom.js')}}" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>
</html>