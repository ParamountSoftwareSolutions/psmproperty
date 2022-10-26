<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/css/login.css')}}"/>
</head>
<body class="body">
<div class="container-fluid ">
    <div class="row d-block mr-0">
        <div class="mx-auto box col-xl-4 col-lg-4 col-sm-6 col-8">
            <div class="style1"></div>
            <div class="style2"></div>
            <div class="style3"></div>
            <div class="style4"></div>
            <h1 class="text-center mb-4">Login</h1>
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" class="form-control" @error('email') is-invalid @enderror tabindex="1" required autofocus required placeholder="Email" value="{{ old('email') }}" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                        Remember Me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block col-xl-4 col-lg-5 col-md-5 col-sm-5 col-7 mx-auto">
                    Login
                </button>
            </form>
        </div>
    </div>
    <div class="footer">
        <div class="container-fluid text-center">
            <div class="row mr-0">
                <div class="mx-auto d-flex pt-2">
                    <p class="">Powered By: Paramount Software Solutions</p>
                    <img src="{{asset('public/panel/assets/img/logo-login.png')}}" width="50px" height="40px" class="logo"/>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
