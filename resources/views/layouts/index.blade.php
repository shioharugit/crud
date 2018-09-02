<html>
<head>
    <title>@yield('title')</title>
    <style>
        body {font-size:16pt; color:#999; margin: 5px; }
        h1 { font-size:50pt; color:#999; margin:-20px 0px -30px 0px; letter-spacing:-4pt; }
        ul { font-size:12pt; }
        hr { margin: 25px 100px; border-top: 1px dashed #ddd; }
        .menutitle {font-size:14pt; font-weight:bold; margin: 0px; }
        .content {margin:10px; }
        .footer { text-align:right; font-size:10pt; margin:10px; border-bottom:solid 1px #ccc; color:#ccc; }
        th {background-color:#999; color:fff; padding:5px 10px; }
        td {border: solid 1px #aaa; color:#999; padding:5px 10px; }
        .text-error { font-size:10pt; color:f00; }
    </style>
    </head>
<body>
    <h1>@yield('title')</h1>
    @section('menubar')
    <ul>
        <p class="menutitle">メニュー</p>
        <li><a href="/crud/public/user">User</a></li>
        <li><a href="/crud/public/csv">Csv</a></li>
    </ul>
    <hr size="1">
    <div class="content">
    @yield('content')
    </div>
    <div class="footer">
    @yield('footer')
    </div>
</body>
</html>