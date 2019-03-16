<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{asset('favicon.ico')}}">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
        <link href="{{asset('css/sticky-footer.css')}}" rel="stylesheet" media="screen">
    </head>
    <body class="bg-light">
        @include('layouts.partials.header')
        <div class="container">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/fileselect.js')}}"></script>
    </body>
</html>