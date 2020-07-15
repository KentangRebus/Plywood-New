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
    <link rel="shortcut icon" href="{{asset('images/logo-mini.svg')}}">
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <title>Login</title>
</head>
<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo d-flex justify-content-center align-content-center">
                            <img style="width: 70px" src="{{asset('images\logo-mini.svg')}}">
                            <span class="mx-3 font-weight-bolder" style="font-size: 55px">PPOS</span>
                        </div>
                        <h4 class="text-center">Hello! let's get started</h4>
                        <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                        <form class="pt-3" method="post" action="{{route('do-login')}}">
                            @csrf
                            <div class="form-group">
                                <input name="username" type="text" class="form-control form-control-lg" id="inputUsername" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control form-control-lg" id="inputPassword" placeholder="Password">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
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