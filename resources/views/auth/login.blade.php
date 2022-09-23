@extends('auth.includes.app')
@section('content')
    <div class="container-custom">
        <div class="row">
            <div class="col-md-5 offset-sm-1">
                <div class="login-section">
                    <a href="#" class="logo-ppms"><img src="{{ asset('public/panel/assets/img/logoppms.png') }}"alt="" /></a>
                    <h3>Sign In</h3>
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" @error('email') is-invalid @enderror tabindex="1" required autofocus required placeholder="Email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required placeholder="Password">
                            <!--  -->
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox" style="font-weight: 400;
              font-size: 14px;color: #272727;    display: inline-block;">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me" >Remember Me</label>
                            </div>
                            <div class="pull-right" style="display: inline-block;;font-weight: 400;
              font-size: 14px;">
                                <a href="{{ route('password.request') }}" style="color: #000000;">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-lg btn-block" >
                                Log In
                            </button>
                        </div>
                        <!-- <div style="text-align: center;font-weight: 400;
                        font-size: 27.62px;">
                          <a href="auth-forgot-password.html" style="color: #000000;">
                            Forgot Password?
                          </a>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="col-md-6 Welcome-section">
                <h3>Manage your properties with<br> One Solution</h3>
                <h2>Welcome Back</h2>
            </div>
        </div>
    </div>


    {{--
    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left text-danger">
        Sign In
    </h2>
    <div class="ntro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center text-white">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
    <form method="POST" action="{{ route('login') }}">
        <div class="intro-x mt-8">
            @csrf
            <input type="email" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Email" @error('email') is-invalid @enderror name="last_name" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
            <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password" @error('password') is-invalid @enderror required>
            @error('password')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
            <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                <input class="form-check-input border mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="cursor-pointer select-none text-danger" for="remember-me">Remember Me</label>
            </div>

            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Sign in</button>
                <button type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</button>
            </div>
            @if (Route::has('password.request'))
                <a class="text-theme-1 dark:text-theme-10 ml-1" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>--}}

@endsection
