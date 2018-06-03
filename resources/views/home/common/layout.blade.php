<!DOCTYPE html>
    <head>
        <title>精品课</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="{{asset('assets/css/layout.css')}}" rel="stylesheet" type="text/css" media="all">
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    </head>
    @if(session('msg'))
        <script>
            alert('{{session('msg')}}')
        </script>
    @endif
    <style>iframe{width: 1px;min-width: 100%}</style>
    <body id="top">
        @include('home.common.navbar')

        @section('header')
            @include('home.common.header')
        @show

        @yield('content')

        @include('home.common.footer')


        <!-- JAVASCRIPTS -->
        <script src="{{asset('assets/js/jquery.backtotop.js')}}"></script>
        <script src="{{asset('assets/js/jquery.mobilemenu.js')}}"></script>
    </body>
</html>
