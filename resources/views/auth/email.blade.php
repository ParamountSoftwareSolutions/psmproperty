
@extends('auth.includes.app')
@section('content')
    <div class="container-custom">
        <div class="row">
            <div class="col-md-5 offset-sm-1">
                <div class="login-section">
                    <a href="#" class="logo-ppms"><img src="{{ asset('public/panel/assets/img/logoppms.png') }}"
                                                       alt=""/></a>
                    <h3>Sign In</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" @error('email') is-invalid
                                   @enderror tabindex="1" required autofocus required placeholder="Email"
                                   value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-lg btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
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
