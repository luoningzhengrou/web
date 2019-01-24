<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title','微博')</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="shortcut icon" href="https://iocaffcdn.phphub.org/uploads/sites/KDiyAbV0hj1ytHpRTOlVpucbLebonxeX.png"/>
    </head>
    <body>
        @include('layouts._header')

    	<div class="container">
            <div class="offset-md-1 col-md-10">
                @include('shared._messages')
                @yield('content')
                @include('layouts._footer')
            </div>
    	</div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
