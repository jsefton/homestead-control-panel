<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terminal</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/theme.css') }}">
    <style>
        body{
            font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #FFFFFF;
            background-color: #002b36;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            padding: 120px 50px 50px 50px;
            font-size: 19px;

        }

        .terminal-heading {
            background: #073642;
            padding: 20px 50px;
            font-size: 26px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .terminal-heading a{
            top: -4px;
            position: relative;
        }

    </style>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://creativecouple.github.com/jquery-timing/jquery-timing.min.js"></script>
    <script>
        $(function() {
            $.repeat(1000, function() {
                $.get('/terminal/tail/artisan-task.log', function(data) {
                    $('#tail').append(data);
                    if(data) {
                        window.scrollTo(0, document.body.scrollHeight);
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="terminal-heading"><a href="{{ url()->previous() }}" class="btn btn-lg btn-success pull-right">Close</a>{{ $logTitle }}</div>
    <div class="wrapper">
        <div id="tail"></div>
    </div>
</body>
</html>