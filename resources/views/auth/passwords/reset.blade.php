{{--@extends('auth.includes.app')

@section('content')
    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Reset Password
        </h2>
        <div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center">Reset Your Password Here</div>
        <form method="POST" action="{{ url('reset-password') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
                --}}{{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}{{--

                <div class="col-md-6">
                    <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection--}}




@extends('auth.includes.app')
@section('content')
    <div class="container-custom">
        <div class="row">
            <div class="col-md-5 offset-sm-1">
                <div class="login-section">
                    <a href="#" class="logo-ppms"><img src="{{ asset('public/panel/assets/img/logoppms.png') }}"alt="" /></a>
                    <h3>Sign In</h3>
                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" @error('email') is-invalid @enderror tabindex="1" required autofocus required placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 Welcome-section">
                <h3>Manage your properties with<br> One Solution</h3>
                <h2>Welcome Back</h2>
            </div>
        </div>
    </div>
@endsection
