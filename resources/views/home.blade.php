{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}
    <!DOCTYPE html>
<html lang="en" class="light">
<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/panel/assets/img/favicon.ico') }}"/>
    <style>
        .Welcome-section {
            background-image: url(public/panel/assets/img/ppbackgound.png);
        }
    </style>
</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="container">
        <div class="row">

            <div class="col-md-5 offset-sm-1">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-section">
                        <a href="#" class="logo-ppms"><img src="{{ asset('public/panel/assets/img/logoppms.png') }}" alt=""/></a>
                        <h3>Sign In</h3>
                        <form>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" tabindex="1" required
                                       autofocus required placeholder="Email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                       required placeholder="Password">
                                <!--  -->
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox" style="font-weight: 400;
              font-size: 31.6239px;color: #272727;">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                           id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-lg btn-block">
                                    Log In
                                </button>
                            </div>
                            <div style="text-align: center;font-weight: 400;
            font-size: 27.62px;">
                                <a href="auth-forgot-password.html" style="color: #000000;">
                                    Forgot Password?
                                </a>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="Welcome-section">
                    <h3>Manage your properties with<br> One Solution</h3>
                    <h2>Welcome Back</h2>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Register Form -->
</div>

<!-- General JS Scripts -->
<script src="{{ asset('public/panel/assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="{{ asset('public/panel/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('public/panel/assets/js/custom.js') }}"></script>

<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        width: '27rem',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    @if ($errors->any())
    @foreach($errors->all() as $error)
    Toast.fire({
        icon: 'error',
        title: '{{ $error }}'
    });
        @endforeach
        @endif

        @if (Session()->has('message'))
    var type = "{{ Session::get('alert') }}";
    switch (type) {
        case'info':
            Toast.fire({
                icon: 'info',
                title: '{{ Session::get("message") }}'
            })
            break;
        case 'success':
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get("message") }}'
            })
            break;
        case 'warning':
            Toast.fire({
                icon: 'warning',
                title: '{{ Session::get("message") }}'
            })
            break;
        case'error':
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get("message") }}'
            })
            break;
    }
    @endif
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function errorMsg(msg){
        Toast.fire({
            icon: 'error',
            title: msg,
        });
    }
    function successMsg(msg){
        Toast.fire({
            icon: 'success',
            title: msg,
        });
    }

</script>
</body>
</html>

