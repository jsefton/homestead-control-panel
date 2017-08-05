<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Homestead Control Panel</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/theme.css') }}">
    <script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>
    <div class="wrapper">
        @include('elements.site-header')
        @include('elements.sidebar')
        <div class="site--content">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
