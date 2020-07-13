<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}">
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body>
<div class="container-scroller">
    @include('nav.topnav', ['data' => 'this is the data'])
    <div class="container-fluid page-body-wrapper">
        @include('nav.sidenav')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/chart.js')}}"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/file-upload.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/todo.js')}}"></script>
    <script src="{{asset('js/todolist.js')}}"></script>
</body>
</html>